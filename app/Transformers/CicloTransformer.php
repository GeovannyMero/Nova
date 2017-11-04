<?php

namespace App\Transformers;

use App\Modelos\Ciclo;
use League\Fractal\TransformerAbstract;

class CicloTransformer extends TransformerAbstract
{
    /**
     * A Fractal transformer.
     *
     * @return array
     */
    public function transform(Ciclo $ciclo)
    {
        return [
            'flujo' => (int)$ciclo->eCodFlujo,
            'identificador' => (int)$ciclo->eCodReg,
            'placaCamion' => (string)$ciclo->aPlacaCamion,
            'nombreChofer' => (string)$ciclo->aNombreChofer,
            'cedulaChofer' => (string)$ciclo->aCedulaChofer,
            'codigoCliente' => (string)$ciclo->eCodCliente,
            'nombreCliente' => (string)$ciclo->aNombreCliente,
            'pasoSiguiente' => (string)$ciclo->ePasoSiguiente,
            'pasoAnterior' => (string)$ciclo->ePasoAnterior,
            'incidente' => (string)$ciclo->aIncidente,
            'pasoIncidente' => (string)$ciclo->ePasoIncidente,
            'observacion' => (string)$ciclo->aObservaciones,
            'ticket' => (string)$ciclo->aTicket,
            'estado' => (string)$ciclo->aEstado,
            'usuarioCreacion' => (string)$ciclo->aUserCreated,
            'fechaCreacion' => (string)$ciclo->dDateCreate,
            'usuarioActualizacion' => (string)$ciclo->aUserUpdate,
            'fechaActualizacion' => (string)$ciclo->dDateUpdate,


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
            'flujo' => 'eCodFlujo',
            'identificador' => 'eCodReg',
            'placaCamion' => 'aPlacaCamion',
            'nombreChofer' => 'aNombreChofer',
            'cedulaChofer' => 'aCedulaChofer',
            'codigoCliente' => 'eCodCliente',
            'nombreCliente' => 'aNombreCliente',
            'pasoSiguiente' => 'ePasoSiguiente',
            'pasoAnterior' => 'ePasoAnterior',
            'incidente' => 'aIncidente',
            'pasoIncidente' => 'ePasoIncidente',
            'observacion' => 'aObservaciones',
            'ticket' => 'aTicket',
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
            'eCodFlujo' => 'flujo',
            'eCodReg' => 'identificador',
            'aPlacaCamion' => 'placaCamion',
            'aNombreChofer' => 'nombreChofer',
            'aCedulaChofer' => 'cedulaChofer',
            'eCodCliente' => 'codigoCliente',
            'aNombreCliente' => 'nombreCliente',
            'ePasoSiguiente' => 'pasoSiguiente',
            'ePasoAnterior' => 'pasoAnterior',
            'aIncidente' => 'incidente',
            'ePasoIncidente' => 'pasoIncidente',
            'aObservaciones' => 'observacion',
            'aTicket' => 'ticket',
            'aEstado' => 'estado',
            'aUserCreated' => 'usuarioCreacion',
            'dDateCreate' => 'usuarioActualizacion',
            'aUserUpdate' => 'usuarioActualizacion',
            'dDateUpdate' => 'fechaActualizacion',
        ];

        return isset($attributes[$index]) ? $attributes[$index] : null;
    }
}
