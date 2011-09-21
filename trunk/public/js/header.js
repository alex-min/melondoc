$(document).ready(function(){
	change_planetes();
	validateFormEnter("#footer form");
  });

function validateFormEnter(id)
{
    $(id).keydown(function(e) {
	    if (e.keyCode == 13) {
		id.submit();
	    }
	});
}

function getDatasPlanet(planet)
{
    myhtml = '<a href="#" class="closeFooter">X</a>';
    myhtml += '<table>';
    myhtml += '<tr><td><a href="/map/showPlanete?search='+planet.reference+'"><img src="'+ planet.image +'" alt="'+ planet.nom  +'"/></a></td><td><ul>';
    if (planet.link_admin != undefined)
	myhtml += '<li><p class="bouton"><a href="'+ planet.link_admin  +'">'+ planet.admin +'</a></p></li>';
    if (planet.link_colonisation != undefined)
	myhtml += '<li><p class="bouton"><a href="'+ planet.link_colonisation  +'">'+ planet.colonisation  +'</a></p></li>';
    if (planet.link_write != undefined)
	myhtml += '<li><p class="bouton"><a href="'+ planet.link_write  +'">'+ planet.write  +'</a></p></li>';
    if (planet.link_friends != undefined)
	myhtml += '<li><p class="bouton"><a href="'+ planet.link_friends  +'">'+ planet.friends  +'</a></p></li>';
    if (planet.link_no_friends != undefined)
	myhtml += '<li><p class="bouton"><a href="'+ planet.link_no_friends  +'">'+ planet.no_friends  +'</a></p></li>';
    if (planet.link_attaque != undefined)
	myhtml += '<li><p class="bouton"><a href="'+ planet.link_attaque  +'">'+ planet.attaque  +'</a></p></li>';
    myhtml += '<li><ul id="FooterDatasPlanet">';
    myhtml += '<li>Nom : '+planet.nom+'</li>';
    myhtml += '<li>Taille : '+planet.taille+'</li>';
    myhtml += '<li>Référence : '+planet.reference+'</li>';
    if (planet.login != null)
	myhtml += '<li>Login : '+planet.login+'</li>';
    myhtml += '</ul></li>';
    myhtml += '</ul></td></tr></table>';
    $("#footer div").html(myhtml);
    $("#footer div .closeFooter").click(function() {
	$("#footer div").remove();
	$("#footer .closeFooter").remove();
	return false;
    });

}
function change_planetes()
{
    var id;

    $("#planetes .prev").click(function(){
	    var current = $("#planetes_content .active");
	    if (current.prev().size() > 0)
		{
		    current.removeClass('active').css('display','none');
		    current.prev().css('display', 'block').addClass('active');
		    id = $(current.prev()).attr("planet_id");
		    requestAjax("mapController", "PlanetAction", "planet_id=" + id, updateRessources, "POST");
		}
	    return false;
	});
    $("#planetes .next").click(function(){
	    var current = $("#planetes_content .active");
	    if (current.next().size() > 0)
		{
		    current.removeClass('active').css('display','none');
		    current.next().css('display', 'block').addClass('active');
		    id = $(current.next()).attr("planet_id");
		    requestAjax("mapController", "PlanetAction", "planet_id=" + id, updateRessources, "POST");
    		}
	    return false;
	});
}

function updateRessources(object)
{
    if (object.metal)
	{
	    $("#r_metal").html(object.metal);
	    $("#r_cristal").html(object.cristal);
	    $("#r_population").html(object.population);
	    $("#r_energie").html(object.energie);
	}
}

function countMyself() {
    // Check to see if the counter has been initialized
    if ( typeof countMyself.counter == 'undefined' ) {
        // It has not... perform the initilization
        countMyself.counter = 0;
    }

    // Do something stupid to indicate the value
    return ++countMyself.counter;
}

function initiate_compteur(mytime, id) {
    $("#compteurB_" + id).compter({
	    time: mytime,
		showUnits: true});
};
