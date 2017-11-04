<?php

namespace App\Transformers;

use App\Modelos\Camion;
use League\Fractal\TransformerAbstract;

class CamionTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Camion $camion)
    {
        return [
            'identificador' => (int)$camion->eCodReg,
            'placa' => (string)$camion->aPlaca,
            'marca' => (string)$camion->aMarca,
            'modelo' => (string)$camion->aModelo,
            'anio' => (string)$camion->aAnio,
            'estado' => (string)$camion->getEstado(),
            'usuarioCreacion' => (string)$camion->aUserCreated,
            'fechaCreacion' => (string)$camion->dDateCreate,
            'usuarioActualizacion' => (string)$camion->aUserUpdate,
            'fechaActualizacion' => (string)$camion->dDateUpdate,


            /*
            'links' => [
                [
                    'rel' => 'self',
                    'href' => route('products.show', $product->id),
                ],
                [
                    'rel' => 'product.buyers',
                    'href' => route('products.buyers.index', $product->id),
                ],
                [
                    'rel' => 'product.categories',
                    'href' => route('products.categories.index', $product->id),
                ],
                [
                    'rel' => 'product.transactions',
                    'href' => route('products.transactions.index', $product->id),
                ],
                [
                    'rel' => 'seller',
                    'href' => route('sellers.show', $product->seller_id),
                ],
            ],
            */
        ];
    }

    public static function originalAttribute($index)
    {
        $attributes = [
            'identificador' => 'eCodReg',
            'placa' => 'aPlaca',
            'marca' => 'aMarca',
            'modelo' => 'aModelo',
            'anio' => 'aAnio',
            'estado' => 'aEstado',
            'usuarioCreacion' => 'aUserCreated',
            'fechaCreacion' => 'dDateCreate',
            'usuarioActualizacion' => 'aUserUpdate',
            'fechaActualizacion' => 'dDateUpdate',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }

    public static function transformedAttribute($index)
    {
        $attributes = [
            'eCodReg' => 'identificador',
            'aPlaca' => 'placa',
            'aMarca' => 'marca',
            'aModelo' => 'modelo',
            'aAnio' => 'anio',
            'aEstado' => 'estado',
            'aUserCreated' => 'usuarioCreacion',
            'dDateCreate' => 'usuarioActualizacion',
            'aUserUpdate' => 'usuarioActualizacion',
            'dDateUpdate' => 'fechaActualizacion',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
