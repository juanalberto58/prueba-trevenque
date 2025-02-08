# Proyecto de Gestión de Productos

Este es un proyecto de gestión de productos que incluye funcionalidades como la creación, edición, eliminación y visualización de productos. Además, incorpora optimizaciones para consultas y rendimiento.

## **Instrucciones para levantar el proyecto**

### **1. Clonar el repositorio**

Primero, clona el repositorio desde GitHub:

```bash
git clone https://github.com/juanalberto58/prueba-trevenque.git
cd prueba-trevenque


### **2. Instalar las dependencias del proyecto**

composer install

### **3. Configurar la base de datos**

cp .env.example .env

DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3306
DB_DATABASE=nombre_de_base_de_datos
DB_USERNAME=usuario
DB_PASSWORD=contraseña



### **4. Ejecutar migraciones y seeders**

php artisan migrate
php artisan db:seed


### **5. Iniciar el servidor**

php artisan serve


## **Endpoints de la API**

### **1. Crear un nuevo producto**

curl -X POST http://127.0.0.1:8000/api/products \
  -H "Content-Type: application/json" \
  -d '{"name": "Nuevo Producto", "price": 25.50, "stock": 10, "category_id": 1, "active": true}'

### **2. Obtener lista de productos**

curl -X GET http://127.0.0.1:8000/api/products

### **3. Obtener un producto específico**

curl -X GET http://127.0.0.1:8000/api/products/1

### **4. Actualizar un producto**

curl -X PUT http://127.0.0.1:8000/api/products/1 \
  -H "Content-Type: application/json" \
  -d '{"name": "Producto Actualizado", "price": 30.00, "stock": 15, "category_id": 1, "active": true}'

### **5. Eliminar un producto**

curl -X DELETE http://127.0.0.1:8000/api/products/1

