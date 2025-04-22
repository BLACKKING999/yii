<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "autores".
 *
 * @property int $id_autor
 * @property string $nombre_autor
 * @property string $nacionalidad
 */
class Autor extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'autores';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre_autor', 'nacionalidad'], 'required'],
            [['nombre_autor'], 'string', 'max' => 100],
            [['nacionalidad'], 'string', 'max' => 50],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_autor' => 'ID',
            'nombre_autor' => 'Nombre del Autor',
            'nacionalidad' => 'Nacionalidad',
        ];
    }

    /**
     * Gets query for [[Libros]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getLibros()
    {
        return $this->hasMany(Libro::class, ['id_autor' => 'id_autor']);
    }
} 