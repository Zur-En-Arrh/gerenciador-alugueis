<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
//$route['default_controller'] = 'usuario';
$route['default_controller'] = 'equipamento';
$route['equipamento/insercao'] = 'equipamento/inserir_equipamento';
$route['equipamento/atualizacao'] = 'equipamento/alterar_equipamento';
$route['equipamento/wishlist/(:num)'] = 'equipamento/colocar_wishlist/$1';
$route['equipamento/wishlist/delecao/(:num)'] = 'equipamento/deletar_item/$1';
$route['equipamento/atualizar/(:num)'] = 'equipamento/gerar_form_atualizar/$1';
$route['pedido/aluguel'] = 'pedido/alugar_equipamento';
$route['pedido/termino/(:num)'] = 'pedido/finalizar_pedido/$1';
$route['pedido/cancelamento'] = 'pedido/cancelar';
$route['equipamento/criacao'] = 'equipamento/gerar_form_criar';
/*
$route['equipamento/pedido'] = 'equipamento/fechar_pedido';
$route['pedido/detalhes/(:num)'] = 'pedido/ver_detalhes/$1';
$route['pedido/pendentes'] = 'pedido/ver_pendentes';
$route['pedido/negociacao'] = 'pedido/mudar_pedido';
$route['pedido/aprovacao/(:num)'] = 'pedido/aprovar/$1';
$route['pedido/usuario'] = 'pedido/ver_pedidos_usuario';
$route['usuario/notificacoes'] = 'usuario/pegar_notificacoes'; 
$route['usuario/relatorios/(:num)'] = 'usuario/gerar_pdf/$1';
$route['usuario/relatorios'] = 'usuario/exibir_relatorios';
 */
$route['usuario/logoff'] = 'usuario/logoff';
$route['administrador/login'] = 'administrador/entrar';
$route['relatorio/(:num)/(:num)/(:num)'] = 'relatorio/gerar/$1/$2/$3';
$route['relatorio/lista'] = 'relatorio/exibir_lista';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
