<?php
namespace App\Library\Services;


/**
 * Class TestTicketService
 * @package App\Library\Services
 */

class DataDisplayAdapterService
{
    /**
     * @param string $className
     * @param array $data
     * @return \App\Library\Models\ViewModel[]
     * @throws \ReflectionException
     */

      function prepareDataToDisplay(string $className, array $data): array{
        $ref = new \ReflectionClass($className);
        $props = $ref->getProperties();
        $viewModelArr = [];
        foreach ($data as $dataItem) {
            $viewModelPropertyArr = [];
            $id = null;
            foreach ($props as $property) {
                $viewModelProperty = new \App\Library\Models\ViewModelProperty($property->name, $dataItem->{$property->name});
                $viewModelPropertyArr[] = $viewModelProperty;

                if ($property->name === 'id') {
                    $id = $dataItem->{$property->name};
                }
            }
            $viewModelArr[] = new \App\Library\Models\ViewModel ($id, $viewModelPropertyArr);
        }
        return $viewModelArr;
    }




}
?>
