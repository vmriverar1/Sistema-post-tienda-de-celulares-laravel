<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Category;
use App\Models\Client;
use App\Models\Product;
use App\Models\Setting;
use App\Models\Store;
use App\Models\Subcategory;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        User::create([
            'name' => "Edwin Campos",
            'role' => "ADMIN",
            'email' => "edwincampos502@gmail.com",
            'email_verified_at' => now(),
            'stores' => '[{"tipo":"store","id":"1"},{"tipo":"store","id":"2"}]',
            'direccion' => 'Cajabamba',
            'celular' => '99999999',
            'dni' => '48484848',
            'store' => '1',
            'estado' => '1',
            'foto' => 'images\default\anonymous.png',
            'password' => '$2y$10$.KRQgRfV1IRyCWG0lJK0zekmdbf2FdSZm8idgQX5GcO3jJ5W3JfLi',
        ]);
        User::create([
            'name' => "Victor Rivera",
            'email' => "victor_m_28@gmail.com",
            'role' => "ADMIN",
            'email_verified_at' => now(),
            'stores' => '[{"tipo":"store","id":"1"},{"tipo":"store","id":"2"}]',
            'direccion' => 'Cajabamba',
            'celular' => '99999999',
            'dni' => '48484848',
            'store' => '1',
            'estado' => '1',
            'foto' => 'images\default\anonymous.png',
            'password' => '$2y$10$.KRQgRfV1IRyCWG0lJK0zekmdbf2FdSZm8idgQX5GcO3jJ5W3JfLi',
        ]);
        Store::create([
            "nombre" => 'Principal',
            "ruc" => '1111111',
            "celular" => '999999999',
            "direccion" => 'direccion N°1',
            "administrador" => '1',
            "foto" => 'images\default\anonymous.png'
        ]);

        // Store::create([
        //     "nombre" => 'Sur',
        //     "ruc" => 'sdfssdf3224324',
        //     "celular" => '999399999',
        //     "direccion" => 'hz N°1',
        //     "administrador" => '1',
        //     "foto" => 'images\default\anonymous.png'
        // ]);

        // Client::create([
        //     "nombre" => 'Juan',
        //     "dni" => '48484848',
        //     "celular" => '999399999',
        //     "direccion" => 'hz N°1',
        //     "email" => 'asd@gmail.com',
        //     'store' => '1',
        //     "foto" => 'images\default\anonymous.png'
        // ]);
        // Category::create([
        //     "nombre" => 'Pantalones',
        //     "titular" => 'nuevos y mejores',
        //     "descripcion" => 'nuevos y mejores',
        //     "orden_menu" => '1',
        //     "complementos" => '[{"tipo":"c","id":"1"},{"tipo":"s","id":"1"}]',
        //     "foto" => 'tienda\categorias\ocasiones394051187.png',
        //     'store' => '1',
        //     "orden_catalogo" => '1'
        // ]);
        // Category::create([
        //     "nombre" => 'Pantalones 1',
        //     "titular" => 'nuevos y mejores',
        //     "descripcion" => 'nuevos y mejores',
        //     "orden_menu" => '2',
        //     "complementos" => '[{"tipo":"c","id":"1"},{"tipo":"s","id":"1"}]',
        //     "foto" => 'tienda\categorias\destacados2123497109.png',
        //     'store' => '2',
        //     "orden_catalogo" => '2'
        // ]);
        // Category::create([
        //     "nombre" => 'Pantalones 2',
        //     "titular" => 'nuevos y mejores',
        //     "descripcion" => 'nuevos y mejores',
        //     "orden_menu" => '3',
        //     "complementos" => '[{"tipo":"c","id":"1"},{"tipo":"s","id":"1"}]',
        //     "foto" => 'tienda\categorias\regalos30941819.png',
        //     'store' => '1',
        //     "orden_catalogo" => '3'
        // ]);
        // Category::create([
        //     "nombre" => 'Pantalones 3',
        //     "titular" => 'nuevos y mejores',
        //     "descripcion" => 'nuevos y mejores',
        //     "orden_menu" => '4',
        //     "complementos" => '[{"tipo":"c","id":"1"},{"tipo":"s","id":"1"}]',
        //     "foto" => 'tienda\categorias\tipo-de-arreglo225619737.png',
        //     'store' => '2',
        //     "orden_catalogo" => '4'
        // ]);
        // Category::create([
        //     "nombre" => 'Pantalones 4',
        //     "titular" => 'nuevos y mejores',
        //     "descripcion" => 'nuevos y mejores',
        //     "orden_menu" => '5',
        //     "complementos" => '[{"tipo":"c","id":"1"},{"tipo":"s","id":"1"}]',
        //     "foto" => 'tienda\categorias\tipos-de-flor163.png',
        //     'store' => '1',
        //     "orden_catalogo" => '5'
        // ]);

        // Subcategory::create([
        //     "nombre" => 'tipo a',
        //     "titular" => 'nuevos y mejores',
        //     "descripcion" => 'nuevos y mejores',
        //     "categoria_id" => '[{"tipo":"c","id":"1"},{"tipo":"c","id":"2"}]',
        //     "complementos" => '[{"tipo":"c","id":"1"},{"tipo":"s","id":"1"}]',
        //     'store' => '1',
        //     "orden_menu" => '5'
        // ]);

        // Subcategory::create([
        //     "nombre" => 'tipo b',
        //     "titular" => 'nuevos y mejores',
        //     "descripcion" => 'nuevos y mejores',
        //     "categoria_id" => '[{"tipo":"c","id":"1"},{"tipo":"c","id":"2"}]',
        //     "complementos" => '[{"tipo":"c","id":"1"},{"tipo":"s","id":"1"}]',
        //     'store' => '2',
        //     "orden_menu" => '5'
        // ]);

        // Subcategory::create([
        //     "nombre" => 'tipo a',
        //     "titular" => 'nuevos y mejores',
        //     "descripcion" => 'nuevos y mejores',
        //     "categoria_id" => '[{"tipo":"c","id":"1"},{"tipo":"c","id":"2"}]',
        //     "complementos" => '[{"tipo":"c","id":"1"},{"tipo":"s","id":"1"}]',
        //     'store' => '1',
        //     "orden_menu" => '5'
        // ]);

        // Subcategory::create([
        //     "nombre" => 'tipo a',
        //     "titular" => 'nuevos y mejores',
        //     "descripcion" => 'nuevos y mejores',
        //     "categoria_id" => '[{"tipo":"c","id":"1"},{"tipo":"c","id":"2"}]',
        //     "complementos" => '[{"tipo":"c","id":"1"},{"tipo":"s","id":"1"}]',
        //     'store' => '2',
        //     "orden_menu" => '5'
        // ]);

        // Brand::create([
        //     "nombre" => 'google',
        //     "foto" => 'storage/marcas/01-1625105002.png'
        // ]);
        // Brand::create([
        //     "nombre" => 'instagram',
        //     "foto" => 'storage/marcas/01-1625105019.png'
        // ]);

        // Product::create([
        //     "nombre" => 'promo 20',
        //     "descripcion" => 'instagram',
        //     "categoria_id" => '[{"id":"1","tipo":"c"},{"id":"4","tipo":"c"}]',
        //     "subcategoria_id" => '[{"id":"1","tipo":"s"},{"id":"4","tipo":"s"}]',
        //     "imei" => '["34543535","3453453453"]',
        //     "stock" => '455',
        //     "brand" => '1',
        //     "tipoprecio" => 'fijo',
        //     "precio" => '44',
        //     "minimomayor" => '15',
        //     "preciomayor" => '30',
        //     "costo" => '5',
        //     "tipo" => 'FISICO',
        //     'store' => '1',
        //     "multimedia" => '["storage\/multimedia\/4b180c3f-b847-4f84-a911-2f4abbd42e94\/01-1625105168.png"]',
        //     "foto" => 'storage/productos/01-1625105168.webp'
        // ]);

        // Product::create([
        //     "nombre" => 'pollos',
        //     "descripcion" => 'juygjhbhjnb',
        //     "categoria_id" => '[{"id":"1","tipo":"c"},{"id":"4","tipo":"c"}]',
        //     "subcategoria_id" => '[{"id":"1","tipo":"s"},{"id":"4","tipo":"s"}]',
        //     "imei" => '["456456456","456546456"]',
        //     "stock" => '50',
        //     "brand" => '1',
        //     "tipoprecio" => 'fijo',
        //     "precio" => '55',
        //     "minimomayor" => '12',
        //     "preciomayor" => '34',
        //     "costo" => '20',
        //     "tipo" => 'FISICO',
        //     'store' => '2',
        //     "multimedia" => '["storage\/multimedia\/d1ca0da5-2cf8-40a1-9633-7b0fce45e619\/01-1625105248.jpeg","storage\/multimedia\/d1ca0da5-2cf8-40a1-9633-7b0fce45e619\/11-1625105248.jpeg","storage\/multimedia\/d1ca0da5-2cf8-40a1-9633-7b0fce45e619\/21-1625105248.jpeg"]',
        //     "foto" => 'storage/productos/01-1625105248.jpg'
        // ]);

        Setting::create([
            "plantilla" => '[]',
            "menu" => '[]',
            "crear" => '[]',
            "editar" => '[]',
            "eliminar" => '[]',
            "otros" => '[]',
            "caja" => '[]',
            "productos" => '[]'
        ]);
    }
}
