<?php

namespace Database\Factories;

use App\Models\Rol;
use Illuminate\Database\Eloquent\Factories\Factory;

class RolFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Rol::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
            $data = $this->setData();
            if(empty($data)){
                $data = [
            'rol' => $this->faker->randomElement(['Administrador', 'Locatario', 'Resposable']),
            'slug' => $this->faker->randomElement(['admin', 'local', 'responsable'])
        ];
            }

        return $data;
    }

   protected function  setData(){
        $args  = array();
        $args['rol'] = $this->faker->randomElement(['Administrador', 'Locatario', 'Resposable']);
        switch ($args['rol']):
            case  'Administrador':
            $args['slug'] = 'admin';
            break;
            case 'Locatario':
                $args['slug'] = 'local';
                break;
            default:
                $args['slug'] = 'responsable';
        endswitch;

    return $args;
    }


}
