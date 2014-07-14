Kujawa / vpit
==============

1) Delete Demo Bundle
----------------------
  * delete the `src/Acme` directory;

  * remove the routing entry referencing AcmeDemoBundle in `app/config/routing_dev.yml`;

  * remove the AcmeDemoBundle from the registered bundles in `app/AppKernel.php`;

  * remove the `web/bundles/acmedemo` directory;

  * empty the `security.yml` file or tweak the security configuration to fit
    your needs.


2) Commandline
---------------
  * create bundle `php app/console generate:bundle --namespace=Acme/HelloBundle --format=yml`

  * Cache clear `./app/console —-env=prod cache:clear`

  * List Routes `./app/console router:debug`

  * Check Route `php app/console router:match /givenPage`

  * include assets `php app/console assets:install web --symlink`

  * check twig syntax `hp app/console twig:lint path_of_bundle|folder|twig-file`


3) Tests
---------
  * run phpunit tests `php phpunit -c app src/Barra/BackBundle`


4) DB
------
  * create entity `php app/console doctrine:generate:entity --entity="BarraDefaultBundle:Product"`

  * updates get/set/repo `php app/console doctrine:generate:entities Barra`

  * create DB `php app/console doctrine:database:create`

  * update DB `php app/console doctrine:schema:update --force`

  * delete DB `php app/console doctrine:database:drop --force`


5) Redirects
-------------
  * without URL change `return $this->forward('BarraDefaultBundle:Default:recipe', array('id' => 1));`

  * with URL change `return $this->redirect($this->generateUrl('barra_default_recipe', array('id' => 1)));`

6) Check kind of request
-------------------------
  * GET `$request->query->get('page');`
  * POST `$request->request->get('page');`
  * AJAX `$request->isXmlHttpRequest();`
  * Lang `$request->getPreferredLanguage(array('de', 'en'));`
  * Requested format `$format = $this->getRequest()->getRequestFormat();`



DB
###########################################################################################################
###########################################################################################################

Controller - Einfache selects
    $repository = $this->getDoctrine()->getRepository('BarraDefaultBundle:Recipe')
    $repository
    ->find('foo') 1 with PK
    ->findOneByColumnName('c1') 1 with c1
    ->findOneBy(array('c1'=>'foo', 'c2'=>'bar')) 1 with c1&c2
    ->findByPrice(12.32) more with c1
    ->findBy(array('c1'=>'foo'), array('c2'=>'ASC')) more ordered by c2
    ->findAll();


DB - Repository
 public function findMaxId()
    {
        $query = $this->createQueryBuilder('ri')
            ->select('MAX(ri.id)')
            ->getQuery();

        $recipes = $query->getSingleResult();

        if ($recipes[1] == null)
            return 0;

        return $recipes[1];
    }

######################################################################################################
######################################################################################################
Template
--------------------------------------------------------------------------------------------------------
{% for i in 0..10 %}
    <div class="{{ cycle(['odd', 'even'], i) }}"> ....

{{ include('BarraDefaultBundle:References:article.html.twig', {'id': 3}) }}
include instead of inherit


Asynchronus include via hinclude.js
    {{ render_include(url(...)) }}
    {{ render_include(controller(...)) }}
        -> for controller add "fragments: { path: /_fragment } to framework: at app/config/config.yml
        -> default content when js is deactive also there
            framework:
                templating:
                    hinclude_default_template: BarraDefaultBundle::hinclude.html.twig
        -> ovveride this default via:
            {{ render_hinclude(controller('...'), { 'default': '.....twig'}) }}


bundle template override: app/Resources/myDemoBundle/views/[SomeController/]newPage.html.twig
    -> cache clear may be necessary

######################################################################################################
######################################################################################################
Functional & Unit Tests



---------------------------------------------------------------------------------------------------------------------

newRecipeIngredient->setIngredient($ingredient)
    => aktuallisiert autom.  Recipe->RecipeIngredient
    => Recipe->getRecipeIngredients() funktioniert automatisch


Ingredient->removeRecipeIngredient($recipeIngredient)
    => entfernt nur den Attributswert im Datensatz
    => unpraktisch, da Datensatz (relation) erhalten bliebe
    => wirft sowieso fehlermeldung, da Attribut auf not nullable gesetzt


Ingredient->addRecipeIngredient($recipeIngredient)
    => unnütz. das recipeIngredient müsste bereits bestehen
    => verlinkung zu Ingredient wird autom. gesetzt




Trans
---------------------------------------------------------------------------------------------------------------------
yml for file:       {% trans_default_domain "layout" %}

tag:                {% trans from 'layout' %}reference{% endtrans %}

filter:             {{ 'reference'|trans({'%name%':'Max'}, 'layout') }}
                    reference: Referenz %name%

variable key:       {{ entry['label']|trans({}, 'layout') }}




Transchoice
---------------------------------------------------------------------------------------------------------------------
filter              {{ 'front.word.comment'|transchoice(count, {}, 'layout') }}

tag                 {% transchoice count with {'%count%': count} from "layout" %}
                        front.word.comment
                    {% endtranschoice %}
                    comment: '{0} no comment|{1} one comment|]1,Inf] %count% comments'



CACHE
---------------------------------------------------------------------------------------------------------------------

use Symfony\Component\HttpFoundation\Response;
$response = newResponse();
// mark the response as either public or private
$response->setPublic();
$response->setPrivate();

// set the private or shared max age$response->
setMaxAge(600);
$response->setSharedMaxAge(600);

// set a custom Cache-Control directive
$response->headers->addCacheControlDirective('must-revalidate', true);


$response
->setCache(array(
    'etag'=>$etag,
    'last_modified'=>$date,
    'max_age'=>10,
    's_maxage'=>10,
    'public'=>true,
    // 'private' => true
));





        public function updateMeasurement($id, $type, $inGr)
        {
            $em = $this->getDoctrine()->getManager();
            $measurement = $em->getRepository('BarraFrontBundle:Measurement')->find($id);
            $measurement->setType($type)->setGr($inGr);
            $em->flush();
            return new Response('Success! Updated measurement');
        }

        public function updateRecipe($id, $name, $ingredient, $measurement, $amount, $firstCookingStep)
        {
            $em = $this->getDoctrine()->getManager();
            $recipe = $em->getRepository('BarraFrontBundle:Recipe')->find($id);
            $recipe->setName($name)->setRating(50)->setVotes(2);
            $em->flush();
            return new Response('Success! Updated recipe');
        }

        public function updateRecipeIngredient($id, $recipe, $ingredient, $position, $measurement, $amount)
        {
            $em = $this->getDoctrine()->getManager();
            $recipeIngredient = $em->getepository('BarraFrontBundle:RecipeIngredient')->find($id);
            $recipeIngredient->setRecipe($recipe)->setIngredient($ingredient)->setPosition($position)
                ->setMeasurement($measurement)->setAmount($amount);
            $em->flush();
            return new Response('Success! Updated relation');
        }

         public function updateIngredient($id, $name, $vegan, $kcal, $protein, $carbs, $sugar, $fat, $gfat, $manufacturer)
        {
            $em = $this->getDoctrine()->getManager();
            $ingredient = $em->getRepository('BarraFrontBundle:Ingredient')->find($id);
            $ingredient->setName($name)->setVegan($vegan)->setKcal($kcal)->setProtein($protein)->setCarbs($carbs)
                ->setSugar($sugar)->setFat($fat)->setGfat($gfat)->setManufacturer($manufacturer);
            $em->flush();
            return new Response('Success! Updated Ingredient');
        }

        public function updateCookingStep($recipe, $step, $description)
        {
            $em = $this->getDoctrine()->getManager();
            $cooking = $em->getRepository('BarraFrontBundle:CookingStep')->findOneBy(array(
                    'recipe'=>$recipe, 'step'=>$step)
            );
            $cooking->setRecipe($recipe)->setStep($step)->setDescription($description);
            $em->flush();
            return new Response('Success! Updated cooking step');
        }

        public function updateReference($company, $website, $description, $started, $finished)
        {
            $em = $this->getDoctrine()->getManager();
            $reference = $em->getRepository('BarraFrontBundle:Reference')->findOneBy(array(
                    'company'=>$company, 'website'=>$website)
            );
            $reference->setCompany($company)->setWebsite($website)->setDescription($description)
                ->setStarted(new \DateTime($started))->setFinished(new \DateTime($finished));
            $em->flush();
            return new Response('Success! Updated reference');
        }

        public function updateManufacturer($id, $name)
        {
            $em = $this->getDoctrine()->getManager();
            $Manufacturer = $em->getRepository('BarraFrontBundle:Manufacturer')->find($id);
            $Manufacturer->setName($name);
            $em->flush();
            return new Response('Success! Updated manufacturer');
        }
