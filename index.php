<?php
session_start();
if(!isset($_SESSION['usuario'])) {
    header('Location: login.php');
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Control de distribución</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <script src="assets/js/vue.js"></script>
    <script src="assets/js/jquery.js"></script>
</head>
<body>
    <section id="app_table">
        <div id="title_section">
            <h1>Control de distribución</h1>
            <button @click="closeSesion">Cerrar sesión</button>
        </div>
        <table cellspacing=0>
            <thead>
                <th>No. Carga</th>
                <th>Fecha</th>
                <th># de Rutas</th>
                <th>Ruta(s) a entregar</th>
                <th>Vehiculo ID</th>
                <th>Tipo</th>
                <th>Marca</th>
                <th>Capacidad Kgs.</th>
                <th># Partidas</th>
                <th># Partidas Escaneadas</th>
                <th>% Escaneado</th>
                <th>Total KGS</th>
                <th>Total KGS Escaneados</th>
                <th>% Escaneado Kgs.</th>
                <th># Clientes</th>
                <th># Pedidos</th>
                <th>Estatus</th>
                <th>Ult. Actualización</th>
            </thead>
            <tbody>
                <tr v-for="items in registros" :class="statusClases(items)" @click="selectedRow">
                    <td class="is-text-right">{{ items.no_carga }}</td>
                    <td>{{ items.fecha }} </td>
                    <td class="is-text-right">{{ items.no_rutas }} </td>
                    <td class="word-space">{{ items.rutas_entregar }} </td>
                    <td class="is-text-right">{{ items.vehiculo_id }} </td>
                    <td>{{ items.tipo }} </td>
                    <td>{{ items.marca }} </td>
                    <td class="is-text-right">{{ helper_format_cant(items.capacidad_kgs) }} </td>
                    <td class="is-text-right">{{ helper_format_cant(items.no_partidas) }} </td>
                    <td class="is-text-right">{{ helper_format_cant(items.partidas_escaneadas) }} </td>
                    
                    <td>
                        <div>
                            <span>{{ items.p_escaneado_partidas }}% </span>
                            <span class="bar_percentage" :style="percent(items.p_escaneado_partidas)"></span>
                        </div>
                    </td>

                    <td class="is-text-right">{{ helper_format_cant(items.total_kgs) }} </td>
                    <td class="is-text-right">{{ helper_format_cant(items.total_kgs_escaneados) }} </td>
                    
                    <td>
                        <div>
                            <span>{{ items.p_escaneado_kgs }}%</span>
                            <span class="bar_percentage" :style="percent(items.p_escaneado_kgs)"></span>
                        </div>
                    </td>

                    <td class="is-text-right">{{ helper_format_cant(items.no_clientes) }} </td>
                    <td class="is-text-right">{{ helper_format_cant(items.no_pedidos) }} </td>
                    <td class="is-text-right is-text-weight-bold">{{ items.estatus }} </td>
                    <td>{{ items.ult_actualizacion }} </td>
                </tr>
            </tbody>
        </table>
    </section>

    <script>
        let app = new Vue({
            el: '#app_table',
            data: {
                registros: [
                    {no_carga:107, fecha:'15/02/2023', no_rutas:3, rutas_entregar:'R29 ORIZBA \n R31 MINATITLAN \n R32 VILLAHERMOSA', vehiculo_id:1, tipo:'TRACTO', marca:'FREIGHTLINER', capacidad_kgs:100, no_partidas:19, partidas_escaneadas:0, p_escaneado_partidas:0, total_kgs:37602.90, total_kgs_escaneados:0, p_escaneado_kgs:0, no_clientes:5, no_pedidos:5, estatus:'EN CARGA', ult_actualizacion: '16/02/23 10:56:43 a.m.'},                
                    {no_carga:105, fecha:'15/02/2023', no_rutas:2, rutas_entregar:'R12 SAN LUIS POTOSÍ \n R90 RIO VERDE', vehiculo_id:37, tipo:'CAMIONETA', marca:'FORD F-350', capacidad_kgs:3500, no_partidas:22, partidas_escaneadas:10, p_escaneado_partidas:45, total_kgs:2271.44, total_kgs_escaneados:2798.64, p_escaneado_kgs:100, no_clientes:6, no_pedidos:6, estatus:'CARGADO', ult_actualizacion: '16/02/23 10:56:43 a.m.'},
                    {no_carga:102, fecha:'15/02/2023', no_rutas:1, rutas_entregar:'R18 IRAPUATO', vehiculo_id:26, tipo:'CAMIONETA', marca:'NISSAN NP-300', capacidad_kgs:1500, no_partidas:20, partidas_escaneadas:0, p_escaneado_partidas:0, total_kgs:896.88, total_kgs_escaneados:0, p_escaneado_kgs:0, no_clientes:5, no_pedidos:5, estatus:'EN CARGA', ult_actualizacion: '16/02/23 10:56:43 a.m.'},
                    {no_carga:101, fecha:'15/02/2023', no_rutas:1, rutas_entregar:'R10 MARAVATIO', vehiculo_id:18, tipo:'CAMIONETA', marca:'FORD F-350', capacidad_kgs:3500, no_partidas:35, partidas_escaneadas:1, p_escaneado_partidas:3, total_kgs:2127.74, total_kgs_escaneados:110, p_escaneado_kgs:5, no_clientes:7, no_pedidos:8, estatus:'EN RUTA', ult_actualizacion: '16/02/23 10:56:43 a.m.'},
                    {no_carga:95, fecha:'15/02/2023', no_rutas:2, rutas_entregar:'R11 ZACATECAS \n R85 AGUASCALIENTES', vehiculo_id:13, tipo:'CAMION TORTON', marca:'KENWORTH', capacidad_kgs:15000, no_partidas:48, partidas_escaneadas:0, p_escaneado_partidas:0, total_kgs:14515.67, total_kgs_escaneados:0, p_escaneado_kgs:0, no_clientes:8, no_pedidos:9, estatus:'VISITANDO CLIENTES', ult_actualizacion: '16/02/23 10:56:43 a.m.'},
                    {no_carga:92, fecha:'15/02/2023', no_rutas:1, rutas_entregar:'R07 CIUDAD HIDALGO', vehiculo_id:19, tipo:'CAMIONETA', marca:'FORD F-350', capacidad_kgs:3500, no_partidas:53, partidas_escaneadas:2, p_escaneado_partidas:4, total_kgs:3940.64, total_kgs_escaneados:1212.40, p_escaneado_kgs:31, no_clientes:17, no_pedidos:24, estatus:'CARGADO', ult_actualizacion: '16/02/23 10:56:43 a.m.'},
                    {no_carga:89, fecha:'15/02/2023', no_rutas:3, rutas_entregar:'R19 SALAMANCA \n R55 VALLE DE SANTIAGO \n R63 URIANGATO', vehiculo_id:23, tipo:'CAMIONETA', marca:'NISSAN NP 300', capacidad_kgs:1500, no_partidas:25, partidas_escaneadas:1, p_escaneado_partidas:4, total_kgs:815.75, total_kgs_escaneados:13.62, p_escaneado_kgs:2, no_clientes:10, no_pedidos:10, estatus:'CARGADO', ult_actualizacion: '16/02/23 10:56:43 a.m.'},
                    {no_carga:87, fecha:'15/02/2023', no_rutas:1, rutas_entregar:'R20 URUAPAN', vehiculo_id:1003, tipo:'GENERICO', marca:'N/A (ALMACEN)', capacidad_kgs:35000, no_partidas:40, partidas_escaneadas:0, p_escaneado_partidas:0, total_kgs:24108.54, total_kgs_escaneados:0, p_escaneado_kgs:0, no_clientes:2, no_pedidos:2, estatus:'EN CARGA', ult_actualizacion: '16/02/23 10:56:43 a.m.'},
                    {no_carga:84, fecha:'15/02/2023', no_rutas:1, rutas_entregar:'R18 IRAPUATO', vehiculo_id:1003, tipo:'GENERICO', marca:'N/A (ALMACEN)', capacidad_kgs:35000, no_partidas:3, partidas_escaneadas:0, p_escaneado_partidas:0, total_kgs:116.64, total_kgs_escaneados:0, p_escaneado_kgs:0, no_clientes:1, no_pedidos:1, estatus:'EN CARGA', ult_actualizacion: '16/02/23 10:56:43 a.m.'},
                    {no_carga:83, fecha:'15/02/2023', no_rutas:1, rutas_entregar:'R65 HUANIMARO', vehiculo_id:1002, tipo:'GENERICA', marca:'N/A (BODEGA)', capacidad_kgs:35000, no_partidas:8, partidas_escaneadas:8, p_escaneado_partidas:100, total_kgs:453, total_kgs_escaneados:455, p_escaneado_kgs:100, no_clientes:1, no_pedidos:1, estatus:'CARGADO', ult_actualizacion: '16/02/23 10:56:43 a.m.'},
                    {no_carga:82, fecha:'15/02/2023', no_rutas:1, rutas_entregar:'R18 IRAPUATO', vehiculo_id:26, tipo:'CAMIONETA', marca:'NISSAN NP 300', capacidad_kgs:1500, no_partidas:14, partidas_escaneadas:0, p_escaneado_partidas:0, total_kgs:427.46, total_kgs_escaneados:0, p_escaneado_kgs:0, no_clientes:6, no_pedidos:8, estatus:'EN CARGA', ult_actualizacion: '16/02/23 10:56:43 a.m.'},
                    {no_carga:81, fecha:'15/02/2023', no_rutas:1, rutas_entregar:'R46 LOS REYES', vehiculo_id:37, tipo:'CAMIONETA', marca:'FORD F-350', capacidad_kgs:3500, no_partidas:4, partidas_escaneadas:3, p_escaneado_partidas:75, total_kgs:56.08, total_kgs_escaneados:51.08, p_escaneado_kgs:91, no_clientes:1, no_pedidos:1, estatus:'CARGADO', ult_actualizacion: '16/02/23 10:56:43 a.m.'},
                    {no_carga:80, fecha:'15/02/2023', no_rutas:2, rutas_entregar:'R21 LEON \n R23 SILAO', vehiculo_id:44, tipo:'CAMIONETA', marca:'NISSAN NP 300', capacidad_kgs:1500, no_partidas:14, partidas_escaneadas:11, p_escaneado_partidas:76, total_kgs:1851.40, total_kgs_escaneados:826.40, p_escaneado_kgs:45, no_clientes:3, no_pedidos:3, estatus:'TERMINADO', ult_actualizacion: '16/02/23 10:56:43 a.m.'},
                    {no_carga:77, fecha:'15/02/2023', no_rutas:3, rutas_entregar:'R06 PATZCUARO \n R13 MORELIA \n R88 TARIMBARO', vehiculo_id:16, tipo:'CAMION RABON', marca:'FREIGHTLINER M2106', capacidad_kgs:8000, no_partidas:53, partidas_escaneadas:25, p_escaneado_partidas:47, total_kgs:6571.56, total_kgs_escaneados:6560.72, p_escaneado_kgs:100, no_clientes:24, no_pedidos:26, estatus:'CARGADO', ult_actualizacion: '16/02/23 10:56:43 a.m.'},
                    {no_carga:75, fecha:'15/02/2023', no_rutas:1, rutas_entregar:'R86 PASTOR ORTIZ', vehiculo_id:43, tipo:'CAMIONETA', marca:'NISSAN NP 300', capacidad_kgs:1500, no_partidas:10, partidas_escaneadas:6, p_escaneado_partidas:64, total_kgs:898, total_kgs_escaneados:1064, p_escaneado_kgs:100, no_clientes:3, no_pedidos:5, estatus:'CARGADO', ult_actualizacion: '16/02/23 10:56:43 a.m.'},
                    {no_carga:74, fecha:'15/02/2023', no_rutas:3, rutas_entregar:'R14 ACAPULCO \n R16 LAZARO CARDENAS \n R87 APATZINGAN', vehiculo_id:1002, tipo:'GENERICA', marca:'NA (BODEGA)', capacidad_kgs:35000, no_partidas:48, partidas_escaneadas:18, p_escaneado_partidas:38, total_kgs:16153.30, total_kgs_escaneados:14694.86, p_escaneado_kgs:91, no_clientes:20, no_pedidos:20, estatus:'DE REGRESO', ult_actualizacion: '16/02/23 10:56:43 a.m.'},
                ],
            },
            created(){
            },
            methods: {
                closeSesion: function(){
                    $.get("assets/api/api_login.php?action=closeSesion",
                    function(data, status) {
                        console.log(data);
                    })
                },
                statusClases: function(status){
                    let classe
                    if(status.estatus == 'EN CARGA'){
                        classe = 'is-red'
                    }
                    if(status.estatus == 'CARGADO') {
                        classe = 'is-orange'
                    }
                    if(status.estatus == 'TERMINADO') {
                        classe = 'is-green'
                    }
                    if(status.estatus == 'DE REGRESO') {
                        classe = 'is-green-light'
                    }
                    if(status.estatus == 'VISITANDO CLIENTES') {
                        classe = 'is-white'
                    }
                    if(status.estatus == 'EN RUTA') {
                        classe = 'is-yellow'
                    }

                    return classe
                },
                helper_format_cant: function(cant){
                    return (parseFloat(cant).toFixed(2)).toLocaleString('en-US')
                },
                percent: function(perce){
                    let widthValue="width:";
                    return widthValue + perce + '%'
                },
                selectedRow: function(e){
                    document.querySelectorAll('table tbody tr').forEach(element => {
                        element.classList.remove('active')
                    })
                    e.target.closest('tr').classList.add('active')
                }
            }
        })
    </script>
</body>
</html>