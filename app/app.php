<?php
    date_default_timezone_set('America/Los_Angeles');
    require_once __DIR__."/../vendor/autoload.php";
    require_once __DIR__."/../src/Stylist.php";
    require_once __DIR__."/../src/Client.php";
    use Symfony\Component\HttpFoundation\Request;
    Request::enableHttpMethodParameterOverride();
    $server = 'mysql:host=localhost:8889;dbname=hair_salon';
    $username = 'root';
    $password = 'root';
    $DB = new PDO($server, $username, $password);
    $app = new Silex\Application();
    $app['debug']= true;

    $app->register(
       new Silex\Provider\TwigServiceProvider(),
       array('twig.path' => __DIR__.'/../views')
    );

    $app->get('', function() use($app) {
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });
    $app->post('', function() use($app) {
        $stylist = new Stylist(filter_var($_POST['name'], FILTER_SANITIZE_MAGIC_QUOTES));
        $stylist->save();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });
    $app->get('/stylist/{id}', function($id) use ($app){
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist.html.twig', array('stylist'=>$stylist,'clients'=>$stylist->getClients()));
    });
    $app->get('/stylist/{id}/edit', function($id) use($app) {
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist_edit.html.twig', array('stylist'=>$stylist));
    });
    $app->patch('/stylist/{id}', function($id) use($app) {
        $new_name = $_POST['name'];
        $stylist= Stylist::find($id);
        $stylist->edit($new_name);
        return $app['twig']->render('stylist.html.twig', array('stylist'=>$stylist, 'clients'=>$stylist->getClients()));
    });
    $app->delete('/{id}', function($id) use($app) {
        $stylist = Stylist::find($id);
        $stylist->delete();
        return $app['twig']->render('index.html.twig', array('stylists' => Stylist::getAll()));
    });
    $app->post('/stylist/{id}', function($id) use($app){
        $client = new Client($_POST['name'], $id=null, $_POST['stylist_id']);
        $client->save();
        $stylist = Stylist::find($_POST['stylist_id']);
        return $app['twig']->render('stylist.html.twig', array('stylist'=>$stylist,'clients'=> $stylist->getClients() ));
    });
    $app->get('/client/{id}/edit',function($id) use($app){
        $client = Client::find($id);
        return $app['twig']->render('client_edit.html.twig', array('client'=>$client));
    });
    $app->patch('/newlist/{id}', function($id) use($app){
        $new_name = $_POST['name'];
        $client = Client::find($_POST['client_id']);
        $client->edit($new_name);
        $stylist = Stylist::find($id);
        return $app['twig']->render('stylist.html.twig', array('stylist'=>$stylist, 'clients'=>$stylist->getClients()));
    });
    $app->delete('/stylist/{id}', function($id) use($app){
        $client = Client::find($_POST['client_id']);
        $client->delete();
        $stylist= Stylist::find($id);
        // return $app->redirect('/stylist/{$client->getStylistId()}');
        return $app['twig']->render('stylist.html.twig', array('stylist'=>$stylist,'clients'=> $stylist->getClients()));
    });

    return $app;

 ?>
