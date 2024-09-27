from flask import Flask, request, redirect, url_for, flash, jsonify, render_template
from flask_mysqldb import MySQL
from flask_wtf.csrf import CSRFProtect
from flask_login import LoginManager, login_user, logout_user, login_required
from config import config
from werkzeug.security import generate_password_hash


# Models:
from models.ModelUser import ModelUser

# Entities:
from models.entities.User import User

app = Flask(__name__)
app.secret_key = 'tu_clave_secreta'  # Necesaria para flash messages

csrf = CSRFProtect()
db = MySQL(app)
login_manager_app = LoginManager(app)

@login_manager_app.user_loader
def load_user(id):
    return ModelUser.get_by_id(db, id)

@app.route('/')
def index():
    return redirect(url_for('login'))

@app.route('/login', methods=['GET', 'POST'])
def login():
    if request.method == 'POST':
        user = User(0, request.form['username'], request.form['password'])
        logged_user = ModelUser.login(db, user)
        if logged_user is not None:
            if logged_user.password:
                login_user(logged_user)
                return redirect(url_for('home'))
            else:
                flash("Contraseña Incorrecta...")
                return render_template('auth/login.html')
        else:
            flash("Usuario Incorrecto...")
            return render_template('auth/login.html')
    else:
        return render_template('auth/login.html')

@app.route('/logout')
def logout():
    logout_user()
    return redirect(url_for('login'))

# Ruta para el home
@app.route('/home')
@login_required
def home():
    return render_template('home.html')  # Cargar la página de forma estática

# Ruta para obtener los productos desde la base de datos en formato JSON
@app.route('/productos')
def get_productos():
    try:
        cursor = db.connection.cursor()
        cursor.execute("SELECT nombre, descripcion, precio, imagen, descuento, estrellas FROM productos")
        productos = cursor.fetchall()
        cursor.close()

        productos_data = []
        for producto in productos:
            producto_dict = {
                'nombre': producto[0],
                'descripcion': producto[1],
                'precio': float(producto[2]),
                'imagen': producto[3],
                'descuento': float(producto[4]),
                'estrellas': float(producto[5])
            }
            productos_data.append(producto_dict)
        
        return jsonify(productos_data)
    
    except Exception as e:
        return jsonify({'error': str(e)}), 500

@app.route('/protected')
@login_required
def protected():
    return "<h1>Esta es una vista protegida, solo para usuarios autenticados.</h1>"

@app.route('/register', methods=['GET', 'POST'])
def register():
    if request.method == 'POST':
        username = request.form['username']
        password = request.form['password']
        fullname = request.form['fullname']

        # Validaciones adicionales
        if len(password) < 6:
            flash("La contraseña debe tener al menos 6 caracteres.")
            return render_template('auth/register.html')
        
        if not username:
            flash("El nombre de usuario no puede estar vacío.")
            return render_template('auth/register.html')


        hashed_password = generate_password_hash(password)

        cursor = db.connection.cursor()
        try:
            # Comprobar si el nombre de usuario ya existe
            cursor.execute("SELECT * FROM user WHERE username = %s", (username,))
            if cursor.fetchone() is not None:
                flash("El nombre de usuario ya está en uso. Elige otro.")
                return render_template('auth/register.html')

            # Inserción del nuevo usuario
            print(f"Inserción de usuario: {username}, {hashed_password}, {fullname}")  # Para depuración
            cursor.execute("INSERT INTO user (username, password, fullname) VALUES (%s, %s, %s)",
                           (username, hashed_password, fullname))
            db.connection.commit()
            flash("Usuario registrado con éxito. Puedes iniciar sesión ahora.")
            return redirect(url_for('login'))

        except Exception as e:
            db.connection.rollback()  # Revertir cambios en caso de error
            flash(f"Error al registrar el usuario: {str(e)}")
            print(f"Error: {str(e)}")  # Imprimir error en la consola

        finally:
            cursor.close()

    return render_template('auth/register.html')



def status_401(error):
    return redirect(url_for('login'))

def status_404(error):
    return "<h1>Página no encontrada</h1>", 404

if __name__ == '__main__':
    app.config.from_object(config['development'])
    csrf.init_app(app)
    app.register_error_handler(401, status_401)
    app.register_error_handler(404, status_404)
    app.run()





