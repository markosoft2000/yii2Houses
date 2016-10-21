<?php
namespace frontend\validators;


use yii\validators\Validator;

class OperationAdvertValidator extends Validator {
    public $message;

    public function init() {
        $this->message = 'Not required value';
    }

    /*
     * add this statement to a rules function of a model
     * {
     * ...
     * ['fieldName', 'frontend\validators\OperationAdvertValidator']
     * }
     */
    public function validateAttribute($model, $attribute) {
        $value = $model->$attribute;

        if (!in_array($value, ['Buy', 'Rent', 'Sale'])) {
            $this->addError($model, $attribute, 'Not required value');
        }
    }

    public function clientValidateAttribute($model, $attribute, $view)
    {
        $message = json_encode($this->message, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE);
        return <<<JS
            var operationValues = ['Buy', 'Rent', 'Sale'];

            function inArray(element, list) {
              return !!(~list.indexOf(element));
            }

            if (!inArray(value, operationValues)) {
              messages.push($message);
            }
JS;
    }
}