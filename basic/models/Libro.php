<?php

namespace app\models;

use yii\db\ActiveRecord;
use yii\caching\DbDependency;

/**
 * This is the model class for table "libros".
 *
 * @property int $id_libro
 * @property string $titulo
 * @property int $id_autor
 * @property int $id_categoria
 * @property int $anio_publicacion
 * @property bool $disponible
 * 
 * @property Autor $autor
 * @property Categoria $categoria
 * @property Prestamo[] $prestamos
 */
class Libro extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'libros';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['titulo', 'id_autor', 'id_categoria', 'anio_publicacion'], 'required'],
            [['id_autor', 'id_categoria', 'anio_publicacion'], 'integer'],
            [['disponible'], 'boolean'],
            [['titulo'], 'string', 'max' => 150],
            [['id_autor'], 'exist', 'skipOnError' => true, 'targetClass' => Autor::class, 'targetAttribute' => ['id_autor' => 'id_autor']],
            [['id_categoria'], 'exist', 'skipOnError' => true, 'targetClass' => Categoria::class, 'targetAttribute' => ['id_categoria' => 'id_categoria']],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_libro' => 'ID',
            'titulo' => 'Título',
            'id_autor' => 'Autor',
            'id_categoria' => 'Categoría',
            'anio_publicacion' => 'Año de Publicación',
            'disponible' => 'Disponible',
        ];
    }

    /**
     * Gets query for [[Autor]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getAutor()
    {
        return $this->hasOne(Autor::class, ['id_autor' => 'id_autor']);
    }

    /**
     * Gets query for [[Categoria]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getCategoria()
    {
        return $this->hasOne(Categoria::class, ['id_categoria' => 'id_categoria']);
    }

    /**
     * Gets query for [[Prestamos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrestamos()
    {
        return $this->hasMany(Prestamo::class, ['id_libro' => 'id_libro']);
    }

    /**
     * Obtiene todos los libros con sus relaciones precargadas
     * @return array
     */
    public static function getAllWithRelations()
    {
        $cacheKey = 'libros_with_relations';
        $cache = \Yii::$app->cache;
        
        // Usar COUNT(*) en lugar de updated_at que no existe en la tabla
        $dependency = new DbDependency([
            'sql' => 'SELECT COUNT(*) FROM libros',
        ]);

        $data = $cache->getOrSet($cacheKey, function () {
            return self::find()
                ->with(['autor', 'categoria'])
                ->asArray()
                ->all();
        }, 3600, $dependency);

        return $data;
    }
} 