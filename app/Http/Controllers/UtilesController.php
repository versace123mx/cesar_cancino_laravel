<?php

namespace App\Http\Controllers;

use App\Models\Productos;
use Mpdf\Mpdf;
use Illuminate\Http\Request;
use PhpOffice\PhpSpreadsheet\IOFactory;
use PhpOffice\PhpSpreadsheet\Spreadsheet;

class UtilesController extends Controller
{
    public function utiles_inicio(){

        return view('utiles.home');
    }

    public function utiles_pdf(){
        $mpdf = new Mpdf();
        $mpdf->WriteHTML('<h1>Hello world!</h1><p>Culoncita dejate oler el peyoyo</p>');
        $mpdf->Output();
    }

    public function utiles_excel(){
        //crea new Spreedsheet object
        $spreadsheet = new Spreadsheet();

        //set document properties
        $spreadsheet->getProperties()->setCreator('Gustavo Marchena')
                    ->setLastModifiedBy('Gustavo')
                    ->setTitle('Ofices prueba')
                    ->setSubject('Offices')
                    ->setDescription('Prueba excel desde laravel')
                    ->setKeywords('offices')
                    ->setCategory('Test');

        $spreadsheet->setActiveSheetIndex(0)
                    ->setCellValue('A1','ID')
                    ->setCellValue('B1','Categoria')
                    ->setCellValue('C1','Nombre')
                    ->setCellValue('D1','Precio')
                    ->setCellValue('E1','Stock')
                    ->setCellValue('F1','Descripcion')
                    ->setCellValue('G1','Fecha');
        $datos = Productos::orderBy('id','desc')->get();
        $i=2;
        foreach($datos as $dato){
            $spreadsheet->getActiveSheet()
                    ->setCellValue('A'.$i,$dato->id)
                    ->setCellValue('B'.$i,$dato->categorias->nombre)
                    ->setCellValue('C'.$i,$dato->nombre)
                    ->setCellValue('D'.$i,$dato->precio)
                    ->setCellValue('E'.$i,$dato->stock)
                    ->setCellValue('F'.$i,$dato->descripcion)
                    ->setCellValue('G'.$i,$dato->fecha);
                    $i++;
        }

        $spreadsheet->getActiveSheet()->setTitle('Hoja 1');

        $spreadsheet->setActiveSheetIndex(0);
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename="reporte_'.date("Y-m-d_H:i:s").'.xlsx"');
        header('Cache-Control: max-age=0');
        header('Cache-Control: maz-age=1');

        header('Cache-Control: cache, must-revalidate');
        header('Pragma: public');

        $write = IOFactory::createWriter($spreadsheet,'Xlsx');
        $write->save('php://output');
        exit;
    }

}
