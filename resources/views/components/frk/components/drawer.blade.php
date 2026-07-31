<div id="sideNav" class="lg:block  bg-primaryColor w-64 h-screen fixed rounded-none border-none">
    <!-- Items -->
    <div class="p-4 space-y-4">

        <!-- Logo -->
        <div class="flex w-full justify-center">


            <div class="mr-2">
                <i class="fa fa-laptop fa-4x text-white" aria-hidden="true"></i>
            </div>

           <!-- <img class="h-11 text-white " src="{!! asset('assets/imagenes/sistema_logo.png') !!}"> -->

        </div>
        <x-frk.components.item_drawer label="Inicio" route="inicio"  icon="fa-solid fa-house"  />
        <x-frk.components.item_drawer label="Nueva Venta" route="venta_rapida" icon="fa-solid fa-cart-shopping" />


        <x-frk.components.item_expanded_drawer label="Inventario y Produc"  icon="fa-solid fa-box-open"  >
            <x-frk.components.subitem_drawer label="Inventario" route="inventario" />
            <x-frk.components.subitem_drawer label="producto" route="producto" />
            <x-frk.components.subitem_drawer label="ajuste_inventario" route="ajuste_inventario" />
            <x-frk.components.subitem_drawer label="traslado" route="traslado" />
            <x-frk.components.subitem_drawer label="compra" route="compra" />
        </x-frk.components.item_expanded_drawer>

        <x-frk.components.item_expanded_drawer label="Venta y Distribucion"  icon="fa-solid fa-truck-fast"  >
            <x-frk.components.subitem_drawer label="detalle venta" route="venta" />
            <x-frk.components.subitem_drawer label="proveedor" route="proveedor" />
            <x-frk.components.subitem_drawer label="ruta" route="ruta" />
            <x-frk.components.subitem_drawer label="envio" route="envio" />
            <x-frk.components.subitem_drawer label="asignacion_ruta" route="asignacion_ruta" />
            <x-frk.components.subitem_drawer label="estado_envio" route="estado_envio" />
            <x-frk.components.subitem_drawer label="vehiculo" route="vehiculo" />
            <x-frk.components.subitem_drawer label="servicios" route="servicio" />
        </x-frk.components.item_expanded_drawer>


        <x-frk.components.item_expanded_drawer label="Finanzas" icon="fa-solid fa-money-bill"  >
            <x-frk.components.subitem_drawer label="credito" route="credito" />
            <x-frk.components.subitem_drawer label="cuenta_cobrar" route="cuenta_cobrar" />
            <x-frk.components.subitem_drawer label="estado_cuenta" route="estado_cuenta" />
            <x-frk.components.subitem_drawer label="cliente" route="cliente" />



        </x-frk.components.item_expanded_drawer>



        <x-frk.components.item_expanded_drawer label="Administracion" icon="fa-solid fa-screwdriver-wrench"  >
            <x-frk.components.subitem_drawer label="usuario" route="usuario" />
            <x-frk.components.subitem_drawer label="sucursal" route="sucursal" />



        </x-frk.components.item_expanded_drawer>

        <x-frk.components.item_expanded_drawer label="Reportes"  icon="fa-solid fa-book"  >



        </x-frk.components.item_expanded_drawer>

        <x-frk.components.item_expanded_drawer label="Otros"  icon="fa-solid fa-toolbox"  >
            <x-frk.components.subitem_drawer label="marca" route="marca" />
            <x-frk.components.subitem_drawer label="tipo" route="tipo" />
            <x-frk.components.subitem_drawer label="diseño" route="disenio" />
            <x-frk.components.subitem_drawer label="material" route="material" />
        </x-frk.components.item_expanded_drawer>
    </div>
</div>



