public function store(){

        $this->validate(['no_venta'=>'required','fecha_nota_credito'=>'required','total_nota_credito'=>"numeric|required|min:0"]);
        $nota=NotaCredito::latest()->first();
        if ($nota) {
            $this->id=$nota->id+1;
            $this->no_nota_credito=$this->id;
        }else{
            $this->id=1;
            $this->no_nota_credito=$this->id;
        }

        $venta=Venta::find($this->venta_id);
        $venta->correlativo_nota_credito+=1;
        //al momento de anular una venta con una nota de credito
        if($this->anulacion_venta){


            NotaCredito::create(
                [
                    'no_nota_credito'=>$this->no_nota_credito,
                    'venta_id'=>$this->venta_id,
                    'fecha_nota_credito'=>$this->fecha_nota_credito,
                    'total_nota_credito'=>$this->cantidad_nota_credito,
                    'cliente_id'=>$venta->cliente_id,
                    'correlativo'=>$venta->correlativo_nota_credito,
                    'anulacion_venta'=>true,
                    'observaciones'=>"Anulacion de la Venta No. $this->venta_id, $this->observaciones",

                ]
            );
            foreach($venta->productos as $key => $value){
                $cantidad_antes = DB::table('producto_sucursal')->where('producto_id','=',$value->id)->where('sucursal_id','=',$venta->sucursal_id)->get();
                $can=(int)$cantidad_antes[0]->cantidad;
                $can=($can+$value->producto_venta->cantidad);
                DB::table('producto_sucursal')
                    ->where('producto_id','=', $value->id,)
                    ->where('sucursal_id','=',$venta->sucursal_id)
                    ->update(['cantidad' => $can]);
                $producto_temp=Producto::find($value->id);
                $producto_temp->existencia+=$value->producto_venta->cantidad;
                $producto_temp->save();
            }

            $venta->nota_credito=true;
            $venta->anulado=true;
            $venta->fecha_anulado=$this->fecha_nota_credito;
            $venta->total_nota_credito=(($this->total_venta-$this->total_nota_credito)-$this->total_abono)-$this->cantidad_nota_credito;
            $venta->save();
            $this->alertaNotificacion("store");

        }else{
           // dd(" para nota de credito normal");
            NotaCredito::create(
            [
                'no_nota_credito'=>$this->no_nota_credito,
                'venta_id'=>$this->venta_id,
                'fecha_nota_credito'=>$this->fecha_nota_credito,
                'total_nota_credito'=>$this->cantidad_nota_credito,
                'cliente_id'=>$venta->cliente_id,
                'correlativo'=>$venta->correlativo_nota_credito,
                'anulacion_venta'=>false,
                'observaciones'=>$this->observaciones,
            ]
            );

    };

            $venta->nota_credito=true;
            $venta->total_nota_credito+=$this->cantidad_nota_credito;
            $venta->save();
            $this->alertaNotificacion("store");

    $this->cancel();
}