<?php

namespace App\Livewire;
use Illuminate\Support\Str;

use App\Constantes\DataSistema;
use App\Models\AjusteInventario;
use App\Models\Producto;
use App\Models\Movimiento;
use App\Models\Sucursal;
use App\Models\Traslado;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Barryvdh\DomPDF\Facade\Pdf ;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\Volt\Compilers\Mount;

use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\WithPagination;
use Exception;
class AjusteInventarioController extends Component
{
    use LivewireAlert;
    use WithPagination;

    use WithPagination;
    public $title='Ajuste Inventario';
    public $data, $per_page=10,  $id_data;
    public $isCreate = false,$isEdit = false, $isShow = false, $isDelete = false;
    public $estadoShow,$estadoFalse="Inactivo",$estadoTrue="Habilitado";
    public $created_at,$updated_at,$disabled=false;

    public $sucursales=null,$id=null;

    public $disabledForm=[];



    ////////////////////
    public $ajuste_inventario_no=null;
    public $productos,$producto_id=null, $descripcion=null, $estado=1,$cantidad_traslado=0,$tipo_ajuste=null,$sucursal_id=null,$nombreProducto;
    public $tipos_ajustes=null;
    ////////////////////


    public $fecha_ajuste_inventario=null;

    ////////////////////



    public $estados=null;
    public $filtroNoAjuste=null;

    public $filtroTipoAjuste=null;

    public $fecha_rango=null;
    public $variablePrueba=null;
    public $anio=null;

    protected $listeners=['create','edit', 'delete','show','exportarFila'];


    public $filtroFecha=null;
    public $filtroFechaInicio=null;
    public $filtroFechaFin=null;
    public $paginas=['5','10','15','20','25','Todo'];





    public function render()
    {
       

        return view('livewire.pages.ajuste_inventario.index');

    }





    public function create(){
        $this->disabledForm[0]=true;
        $this->fecha_ajuste_inventario= Carbon::now()->toDateString();
        $this->tipos_ajustes=DataSistema::$tipo_ajuste_invetario;
        $this->ajuste_inventario_no=AjusteInventario::siguienteNoRegistro();

        $this->productos=Sucursal::find(Auth::user()->sucursal_id);
        $this->isCreate=true;
    }

    public function store(){


        $this->validate([
            'ajuste_inventario_no'=>'required',
            'producto_id' => 'required',
            'tipo_ajuste' => 'required',
            'cantidad_traslado' => 'numeric|required|min:1|max:99999',
        ]);


        if($this->cantidad_traslado==0 ){
            $this->addError('cantidad_traslado', 'La cantidad debe ser superior a 0');
        }
            AjusteInventario::create(
                [
                'ajuste_inventario_no'=>$this->ajuste_inventario_no,
                'fecha_ajuste_inventario'=>$this->fecha_ajuste_inventario,
                'producto_id'=>$this->producto_id,
                'tipo_ajuste'=>$this->tipo_ajuste,
                'descripcion'=>$this->descripcion,
                'cantidad_traslado'=>$this->cantidad_traslado,
                'sucursal_id'=>Auth::user()->sucursal_id,
                ]
            );

            $pro_sucu=DB::table('producto_sucursal')
            ->where('producto_id' ,'=', $this->producto_id)
            ->where('sucursal_id','=', Auth::user()->sucursal_id)
            ->first();




            if($this->tipo_ajuste=="ingreso"){
                $cant=$this->cantidad_traslado+$pro_sucu->cantidad;
            }else{
                $cant=$pro_sucu->cantidad-$this->cantidad_traslado;
            }

            $pro_sucu=DB::table('producto_sucursal')
            ->where('producto_id' ,'=', $this->producto_id)
            ->where('sucursal_id','=', Auth::user()->sucursal_id)
            ->update(['cantidad' => $cant]);

            $da=DB::table('producto_sucursal')
            ->where('producto_id' ,'=', $this->producto_id)
            ->where('sucursal_id','=', Auth::user()->sucursal_id)
            ->sum('cantidad');


        Producto::find($this->producto_id)
                ->update(['existencia' => $da]);


            $this->cancel();
    }


    public function delete($rowId){
        $data = AjusteInventario::find($rowId);
        $this->ajuste_inventario_no=$data->ajuste_inventario_no;
        $this->id_data=$data->id;
        $this->ajuste_inventario_no = $data->ajuste_inventario_no;
        $this->isDelete = true;
}

public function destroy($rowId)
{
    $data=AjusteInventario::find($rowId);

    $pro_sucu=DB::table('producto_sucursal')
    ->where('producto_id' ,'=', $data->producto_id)
    ->where('sucursal_id','=', $data->sucursal_id)
    ->first();

    if($data->tipo_ajuste=="0"){
        $cant=$pro_sucu->cantidad-$data->cantidad_traslado;
    }else{
        $cant=$pro_sucu->cantidad+$data->cantidad_traslado;
    }

    $pro_sucu=DB::table('producto_sucursal')
    ->where('producto_id' ,'=', $data->producto_id)
    ->where('sucursal_id','=', $data->sucursal_id)
    ->update(['cantidad' => $cant]);



    $da=DB::table('producto_sucursal')
        ->where('producto_id' ,'=', $data->producto_id)
        ->sum('cantidad');


    Producto::find($data->producto_id)
            ->update(['existencia' => $da]);





    $data->delete();


    $this->cancel();

}

    public function show($rowId){
        $this->disabled=true;
        $data = AjusteInventario::findOrFail($rowId);


        $this->ajuste_inventario_no=$data->ajuste_inventario_no;
        $this->fecha_ajuste_inventario=$data->fecha_ajuste_inventario;
        $this->nombreProducto=$data->producto->nombre;
        $this->tipo_ajuste=$data->tipo_ajuste;
        $this->descripcion=$data->descripcion;
        $this->cantidad_traslado=$data->cantidad_traslado;
        $this->sucursal_id=$data->sucursal_id;
        $this->isShow=true;
        $this->disabled=true;
    }

   public function exportarFila($rowId)
    {
        $data_temp=AjusteInventario::find($rowId);
         $data=exportarFilaPDF('AjusteInventario', [
            'data' => $data_temp,
        ]);
        return $data;
    }


    public function cancel(){
        $this->dispatch('pg:eventRefresh-ajusteInventarioTable');
        $this->resetInputFields();
        $this->resetValidation();

    }

    private function resetInputFields(){
        $this->reset(['isCreate','isEdit','isShow','isDelete','disabled','estado','created_at','updated_at']);
        ///////////////////
        $this->reset(['producto_id','tipo_ajuste','descripcion','cantidad_traslado']);
        ////////////////////
    }

    public function pdfExportar($id){


        return redirect()->route('pdfExportarAjusteInventario',$id);

    }

    public function pdfExportarAjusteInventario($id)
    {
        $ajuste_inventario=AjusteInventario::find($id)->toArray();
        $producto = Producto::find($ajuste_inventario['producto_id'])->toArray();
        $sucursal = Sucursal::find($ajuste_inventario['sucursal_id'])->toArray();







    //$pdf = Pdf::loadView('pdf.invoice', $data);



        $pdf = Pdf::loadView('/livewire/pdf/pdfAjusteInventario',['ajuste_inventario' => $ajuste_inventario,'producto'=>$producto,'sucursal'=>$sucursal]);

        //$pdf = Pdf::loadView('pdf.invoice', $data);
       // return $pdf->download("venta_$no_venta.pdf");

        //return redirect()->route('pdfVentaRapida',$id);

        //return $pdf->download('venta_pdf.pdf');
        //return $pdf->download("ajuste_inventario.pdf");
            return $pdf->stream();
        //return $pdf->download('itsolutionstuff.pdf');

    }







}
