var sr;
var pref = store;


function search() {
    var currentTime = moment().format("HH:mm");
    currentTime = '00:00';
    sr.model = allRoutes.getAllRoutes($("#origin").val(), $("#destination").val(), currentTime);
    sr.render();

    sr.scrollTo(moment(), 0); //Start off at the current time

    //Save origin and destination for later
    pref.set("origin", $("#origin").val());
    pref.set("destination", $("#destination").val());


}


$(function () {
    sr = new SearchResultView({el: $("#searchResult"), model: new SearchResult()});

    _.each(stopNames, function (v) {
        var o = $("<option></option>").attr("value", v).text(v);
        if (pref.get("origin") == v) o.attr("selected", "selected");
        $('#origin').append(o);
    });
    _.each(stopNames, function (v) {
        var o = $("<option></option>").attr("value", v).text(v);
        if (pref.get("destination") == v) o.attr("selected", "selected");
        $('#destination').append(o);
    });


    $("#origin,#destination").on("change", search);

    search();


    //Scroll to current time every minute
    setInterval(function () {
        sr.scrollTo(moment(), 1000);
    }, 1000 * 60);

});



