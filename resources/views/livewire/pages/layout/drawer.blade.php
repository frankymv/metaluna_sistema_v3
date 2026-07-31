<div id="sideNav" class="lg:block  bg-primaryColor w-64 h-screen fixed rounded-none border-none z-50">


 <!-- SIDEBAR -->
    <aside
        id="sideNav"
        :class="open ? 'translate-x-0' : '-translate-x-full'"
        class="fixed z-50 lg:translate-x-0 transition-transform duration-300
               bg-primaryColor w-64 h-screen text-white shadow-xl"
    >

        <!-- LOGO -->
        <div class="flex justify-center py-6 border-b border-white/20">
            <img
                src="{{ asset('assets/imagenes/logo_metaluna_blanco.png') }}"
                class="h-10"
            >
        </div>

        <!-- MENU -->
        <nav class="p-4 space-y-1 overflow-y-auto h-[calc(100vh-80px)]">

            <!-- ITEM SIMPLE -->
            <x-frk.components.item_drawer
                label="Inicio"
                route="inicio"
                icon="fa-solid fa-house"
                :active="request()->routeIs('inicio')"
            />

            <x-frk.components.item_drawer
                label="Nueva Venta"
                route="venta_rapida"
                icon="fa-solid fa-cart-shopping"
                :active="request()->routeIs('venta_rapida')"
            />

            <x-frk.components.item_drawer
                label="Nueva Cotización"
                route="cotizacion"
                icon="fa-solid fa-pencil"
                :active="request()->routeIs('cotizacion')"
            />

            <!-- INVENTARIO -->
            <x-frk.components.item_expanded_drawer
                label="Inventario / Producto"
                icon="fa-solid fa-box-open"
                :active="request()->routeIs([
                    'inventario','producto','ajuste_inventario',
                    'traslado','marca','tipo','disenio','material','compra'
                ])"
            >
                <x-frk.components.subitem_drawer label="Inventario" route="inventario" />
                <x-frk.components.subitem_drawer label="Producto" route="producto" />
                <x-frk.components.subitem_drawer label="Ajuste Inventario" route="ajuste_inventario" />
                <x-frk.components.subitem_drawer label="Traslado" route="traslado" />
                <x-frk.components.subitem_drawer label="Marca" route="marca" />
                <x-frk.components.subitem_drawer label="Tipo" route="tipo" />
                <x-frk.components.subitem_drawer label="Diseño" route="disenio" />
                <x-frk.components.subitem_drawer label="Material" route="material" />
                <x-frk.components.subitem_drawer label="Compra" route="compra" />
            </x-frk.components.item_expanded_drawer>

            <!-- TRANSPORTE -->
            <x-frk.components.item_expanded_drawer
                label="Transporte y Logística"
                icon="fa-solid fa-truck-fast"
                :active="request()->routeIs(['envio','ruta','vehiculo','servicio'])"
            >
                <x-frk.components.subitem_drawer label="Envío" route="envio" />
                <x-frk.components.subitem_drawer label="Ruta" route="ruta" />
                <x-frk.components.subitem_drawer label="Vehículo" route="vehiculo" />
                <x-frk.components.subitem_drawer label="Servicios" route="servicio" />
            </x-frk.components.item_expanded_drawer>

            <!-- FINANZAS -->
            <x-frk.components.item_expanded_drawer
                label="Finanzas"
                icon="fa-solid fa-money-bill"
                :active="request()->routeIs([
                    'venta','credito','abono','nota_credito',
                    'estado_cuenta_venta','estado_cuenta','cliente',
                    'combustible','viatico'
                ])"
            >
                <x-frk.components.subitem_drawer label="Venta" route="venta" />
                <x-frk.components.subitem_drawer label="Crédito" route="credito" />
                <x-frk.components.subitem_drawer label="Abono" route="abono" />
                <x-frk.components.subitem_drawer label="Nota Crédito" route="nota_credito" />
                <x-frk.components.subitem_drawer label="Estado Cuenta Venta" route="estado_cuenta_venta" />
                <x-frk.components.subitem_drawer label="Estado Cuenta Cliente" route="estado_cuenta" />
                <x-frk.components.subitem_drawer label="Cliente" route="cliente" />
                <x-frk.components.subitem_drawer label="Combustible" route="combustible" />
                <x-frk.components.subitem_drawer label="Viático" route="viatico" />
            </x-frk.components.item_expanded_drawer>

            <!-- ADMIN -->
            <x-frk.components.item_expanded_drawer
                label="Administración"
                icon="fa-solid fa-screwdriver-wrench"
                :active="request()->routeIs(['usuario','roles','sucursal','proveedor'])"
            >
                <x-frk.components.subitem_drawer label="Usuario" route="usuario" />
                <x-frk.components.subitem_drawer label="Rol" route="roles" />
                <x-frk.components.subitem_drawer label="Sucursal" route="sucursal" />
                <x-frk.components.subitem_drawer label="Proveedor" route="proveedor" />
            </x-frk.components.item_expanded_drawer>

        </nav>
    </aside>




</div>


