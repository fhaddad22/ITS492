var Stop = Backbone.Model.extend({
    defaults: function () {
        return {
            name: "No name",
            id: null,
            position: null,
            times: [],
        };
    },
    getTimes: function (onlyAfter) {
        //if(times === undefined) throw new Error("No time array defined");
        var t = "";
        var mt = null;
        var today = moment();
        var fullTimes = [];
        _.each(this.get("times"), function (t) {
            mt = moment(today.format("YYYY-MM-DD") + " " + t, "YYYY-MM-DD HH:mm");
            if (onlyAfter !== undefined && mt.isBefore(onlyAfter)) return false;

            fullTimes.push(mt);
        });
        return fullTimes;
    }
});

var Stops = Backbone.Collection.extend({
    model: Stop
});

var Route = Backbone.Model.extend({
    defaults: function () {
        return {
            name: "No name",
            description: "",
            cssClass: null,
            days: [],
            stops: new Stops()
        };
    },
    addStop: function (stop) {
        this.get("stops").add(stop);
    },
    hasStop: function (stopName) {
        if (stopName === undefined) return false;

        var foundStop = false;
        this.get("stops").each(function (s) {
            if (s.get("name").localeCompare(stopName) === 0) {
                foundStop = true;
            }
        });
        return foundStop;
    },
    runningToday: function () {
        //Should also check to days the bus is not running
        if (this.runningOnDayOfWeek(moment().day() + 1)) return true;
        else return false;
    },
    runningOnDayOfWeek: function (dayNumber) {

        if (dayNumber === undefined) throw new Error("dayNumber not defined");
        if (dayNumber < 1 || dayNumber > 7) throw new Error("Day number out of range (1-7)");

        if (this.get("days").indexOf(dayNumber) >= 0) return true;
        else return false;
    },
    getStop: function (stopName) {
        return this.get("stops").findWhere({name: stopName});
    }
});


var Trip = Backbone.Model.extend({
    defaults: function () {
        return {
            route: null,
            departure: null,
            arrival: null,
            origin: null,
            destination: null
        };
    }
});


var Routes = Backbone.Collection.extend({
    model: Route,
    getAllRoutes: function (fromStop, toStop, time) {
        if (fromStop === undefined || toStop === undefined || time === undefined) throw new Error("All arugments must be passed in");

        if (fromStop.localeCompare(toStop) === 0) return null;

        var today = moment();
        var startTime = moment(today.format("YYYY-MM-DD") + " " + time, "YYYY-MM-DD HH:mm");
        var result = new SearchResult();

        _.each(this.models, function (route) {

            // Commented out while testing on Sat/Sun
            //if(!route.runningToday()) return false;

            if (!route.hasStop(fromStop) || !route.hasStop(toStop)) return false;


            var fromStopTimes = route.getStop(fromStop).getTimes(startTime).sort();

            if (fromStopTimes.length < 1) return false;

            var toStopTimes = route.getStop(toStop).getTimes(fromStopTimes[0]).sort();


            _.each(fromStopTimes, function (stop, i) {
                if (toStopTimes[i]) {
                    result.add(new Trip({
                        route: route.cid,
                        departure: fromStopTimes[i],
                        arrival: toStopTimes[i]
                    }));
                }
            });
        });
        return result;
    }
});


var SearchResult = Backbone.Collection.extend({
    model: Trip,
    comparator: function (t) {
        return t.get("arrival");
    }
});


var SearchResultView = Backbone.View.extend({


    initialize: function () {
        this.listenTo(this.model, "change", this.render);
        this.listenTo(this.model, "add", this.render);
        this.render();
    },

    render: function () {
        if (this.model === null || this.model.length <= 0) {
            $(this.el).html('<div class="no-result">No results</div>');
        }
        else {
            var el = this.el;
            var html = '';
            html += '<div class="col-md-11">';
            _.each(this.model.models, function (r) {
                html += '<div class="row trip';
                var cssClass = allRoutes.get(r.get("route")).get("cssClass");
                if (cssClass) html += ' ' + cssClass;
                html += '" data-departure="' + r.get("departure").unix() + '">';
                html += '<div class="trip-icon pull-left"></div>';
                html += '<div class="trip-info">';
                html += '<div class="trip-time"> ' + r.get("departure").format("h:mm a") + ' <span class="glyphicon glyphicon-arrow-right"></span> ' + r.get("arrival").format("h:mm a") + '</div>';
                var duration = r.get("arrival").diff(r.get("departure"), 'minutes');
                html += '<div class="trip-duration"><span class="glyphicon glyphicon-time"></span> ' + duration + " min</div>";
                html += "</div>";
                html += "</div>";
            });
            html += '</div>';
            $(this.el).html(html);
        }

    },

    scrollTo: function (timeStamp, animationTime) {
        var scrollToElement = null;
        timeStamp = moment(timeStamp);
        var includeTripWithinTime = moment.duration(5, 'm'); //5 minutter

        $("#searchResult .trip").each(function () {
            tripDeparture = moment.unix($(this).attr('data-departure'));
            if (timeStamp.unix() <= tripDeparture.add(includeTripWithinTime).unix()) {
                scrollToElement = this;
                return false;
            }
        });

        if (scrollToElement !== null) {
            $('html, body').animate({
                scrollTop: $(scrollToElement).offset().top - 50
            }, animationTime);
        }
        else {
            console.log("whaaaat");
        }

    }

});



