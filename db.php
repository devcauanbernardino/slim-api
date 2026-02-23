<?php 

use DI\ContainerBuilder;
require __DIR__ . '/vendor/autoload.php';

// Instantiate PHP-DI ContainerBuilder
$containerBuilder = new ContainerBuilder();

// Set up settings
$settings = require __DIR__ . '/app/settings.php';
$settings($containerBuilder);

$dependencies = require __DIR__ . '/app/dependencies.php';
$dependencies($containerBuilder);

// CRIAR O CONTAINER
$container = $containerBuilder->build();

$db = $container->get('db');
$schema = $db->schema();
$tabela = 'produtos';

// Deleta se já existir e cria de novo
$schema->dropIfExists($tabela); // Faltou passar o nome da tabela aqui

$schema->create($tabela, function($table) {
    $table->increments('id');
    $table->string('titulo');
    $table->text('descricao');
    $table->decimal('preco', 11, 2);
    $table->string('fabricante', 60);
    $table->date('dt_criacao');
});

$db->table($tabela)->insert([
    'titulo' => 'Smartphone',
    'descricao' => 'Android',
    'preco' => '899',
    'fabricante' => 'Motorola',
    'dt_criacao' => '2019-10-22'
]);

$db->table($tabela)->insert([
    'titulo' => 'Iphone',
    'descricao' => 'IOS',
    'preco' => '4999',
    'fabricante' => 'Apple',
    'dt_criacao' => '2020-01-10'
]);

echo "Tabela '$tabela' criada com sucesso!";