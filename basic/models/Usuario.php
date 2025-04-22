<?php

namespace app\models;

use yii\db\ActiveRecord;

/**
 * This is the model class for table "usuarios".
 *
 * @property int $id_usuario
 * @property string $nombre
 * @property string $correo
 * @property string $contrasena
 * @property string $fecha_registro
 */
class Usuario extends ActiveRecord
{
    /**
     * {@inheritdoc}
     */
    public static function tableName()
    {
        return 'usuarios';
    }

    /**
     * {@inheritdoc}
     */
    public function rules()
    {
        return [
            [['nombre', 'correo', 'contrasena'], 'required'],
            [['fecha_registro'], 'safe'],
            [['nombre'], 'string', 'max' => 100],
            [['correo'], 'string', 'max' => 100],
            [['contrasena'], 'string', 'max' => 255],
            [['correo'], 'unique'],
        ];
    }

    /**
     * {@inheritdoc}
     */
    public function attributeLabels()
    {
        return [
            'id_usuario' => 'ID',
            'nombre' => 'Nombre',
            'correo' => 'Correo',
            'contrasena' => 'Contraseña',
            'fecha_registro' => 'Fecha de Registro',
        ];
    }

    /**
     * Gets query for [[Prestamos]].
     *
     * @return \yii\db\ActiveQuery
     */
    public function getPrestamos()
    {
        return $this->hasMany(Prestamo::class, ['id_usuario' => 'id_usuario']);
    }

    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {
            if ($this->isNewRecord) {
                $this->contrasena = Yii::$app->security->generatePasswordHash($this->contrasena);
            }
            return true;
        }
        return false;
    }
} 