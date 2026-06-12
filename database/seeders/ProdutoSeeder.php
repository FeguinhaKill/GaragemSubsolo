<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Produto;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        Produto::make([
            'nome' => 'Mtb Ksw',
            'marca' => 'Ksw',
            'preco' => 1500.00,
            'descricao' => 'Bicicleta mountain bike de alta qualidade',
            'tipo' => 'Bicicleta',
            'imagem' => 'images/produtos/bike1.jpeg',
        ])->save();

        Produto::make([
            'nome' => 'Vikingx Tuff 25',
            'marca' => 'Vikingx',
            'preco' => 1699.00,
            'descricao' => 'Bicicleta mountain bike de alta qualidade e rosa. Aro 29',
            'tipo' => 'Bicicleta',
            'imagem' => 'images/produtos/bike2.jpeg',
        ])->save();

        Produto::make([
            'nome' => 'Gts M1',
            'marca' => 'Shimano',
            'preco' => 950.00,
            'descricao' => 'Bicicleta mountain bike de alta qualidade e branca. Aro 29',
            'tipo' => 'Bicicleta',
            'imagem' => 'images/produtos/bike3.jpeg',
        ])->save();

        Produto::make([
            'nome' => 'Amazonas Flower',
            'marca' => 'AMAZONAS',
            'preco' => 700.00,
            'descricao' => 'Bicicleta para crianças, com cores vibrantes. Aro 16',
            'tipo' => 'Bicicleta',
            'imagem' => 'images/produtos/bike4.jpeg',
        ])->save();

        Produto::make([
            'nome' => 'Bicicleta Infantil Fireman',
            'marca' => 'Ksw',
            'preco' => 1500.00,
            'descricao' => 'Bicicleta infantil com design de bombeiro. Aro 12',
            'tipo' => 'Bicicleta',
            'imagem' => 'images/produtos/bike5.jpeg',
        ])->save();

        Produto::make([
            'nome' => 'Bike meio barata',
            'marca' => 'Cockroach',
            'preco' => 15.00,
            'descricao' => 'Bicicleta com estilo meio barata. Perfeita para quem quer andar come estilo entre o esgoto da cidade. Aro 03, Bicicleta com estilo meio barata. Perfeita para quem quer andar come estilo entre o esgoto da cidade. Aro 03, Bicicleta com estilo meio barata. Perfeita para quem quer andar come estilo entre o esgoto da cidade. Aro 03, Bicicleta com estilo meio barata. Perfeita para quem quer andar come estilo entre o esgoto da cidade. Aro 03, Bicicleta com estilo meio barata. Perfeita para quem quer andar come estilo entre o esgoto da cidade. Aro 03, Bicicleta com estilo meio barata. Perfeita para quem quer andar come estilo entre o esgoto da cidade. Aro 03, Bicicleta com estilo meio barata. Perfeita para quem quer andar come estilo entre o esgoto da cidade. Aro 03, Bicicleta com estilo meio barata. Perfeita para quem quer andar come estilo entre o esgoto da cidade. Aro 03 , Bicicleta com estilo meio barata. Perfeita para quem quer andar come estilo entre o esgoto da cidade. Aro 03,Bicicleta com estilo meio barata. Perfeita para quem quer andar come estilo entre o esgoto da cidade. Aro 03 Bicicleta com estilo meio barata. Perfeita para quem quer andar come estilo entre o esgoto da cidade. Aro 03 Bicicleta com estilo meio barata. Perfeita para quem quer andar come estilo entre o esgoto da cidade. Aro 03 Bicicleta com estilo meio barata. Perfeita para quem quer andar come estilo entre o esgoto da cidade. Aro 03 v Bicicleta com estilo meio barata. Perfeita para quem quer andar come estilo entre o esgoto da cidade. Aro 03 Bicicleta com estilo meio barata. Perfeita para quem quer andar come estilo entre o esgoto da cidade. Aro 03 Bicicleta com estilo meio barata. Perfeita para quem quer andar come estilo entre o esgoto da cidade. Aro 03 Bicicleta com estilo meio barata. Perfeita para quem quer andar come estilo entre o esgoto da cidade. Aro 03 Bicicleta com estilo meio barata. Perfeita para quem quer andar come estilo entre o esgoto da cidade. Aro 03 Bicicleta com estilo meio barata. Perfeita para quem quer andar come estilo entre o esgoto da cidade. Aro 03 Bicicleta com estilo meio barata. Perfeita para quem quer andar come estilo entre o esgoto da cidade. Aro 03 ',
            'tipo' => 'Bicicleta',
            'imagem' => 'images/produtos/bike6.jpeg',
        ])->save();

        Produto::make([
            'nome' => 'Bicicleta Infantil Unitoys Moto Cross',
            'marca' => 'Unitoys',
            'preco' => 1500.00,
            'descricao' => 'A Bicicleta Infantil Unitoys Moto Cross Aro 16 é a escolha perfeita para os pequenos aventureiros que procuram diversão com segurança. Vamos explorar por que essa bike pode ser ideal para seu filho ou filha.. Aro 16',
            'tipo' => 'Bicicleta',
            'imagem' => 'images/produtos/bike7.jpeg',
        ])->save();

        
        Produto::make([
            'nome' => 'Luvinha rosinah uuuu',
            'marca' => 'Luvinha',
            'preco' => 150.00,
            'descricao' => 'luva luuAva pra mao luva',
            'tipo' => 'Acessório',
            'imagem' => 'images/produtos/equipamento1.jpeg',
        ])->save();
        
        Produto::make([
            'nome' => 'Bomba de pneu',
            'marca' => 'Bomba',
            'preco' => 180.00,
            'descricao' => 'bomba bomba bamo',
            'tipo' => 'Acessório',
            'imagem' => 'images/produtos/equipamento2.jpeg',
        ])->save();

        Produto::make([
            'nome' => 'Garrafa de beber',
            'marca' => 'Garrafa',
            'preco' => 165.00,
            'descricao' => 'garrafa de garrafinha',
            'tipo' => 'Acessório',
            'imagem' => 'images/produtos/equipamento3.jpeg',
        ])->save();

        Produto::make([
            'nome' => 'Bolsa Bolsinha',
            'marca' => 'Bolsa',
            'preco' => 200.00,
            'descricao' => 'Bolsa bolsinha bolsa de bolsar',
            'tipo' => 'Acessório',
            'imagem' => 'images/produtos/equipamento4.jpeg',
        ])->save();

        Produto::factory()->count(6)->create();
    }
}
