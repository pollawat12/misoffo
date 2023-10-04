! function (c) {
    "use strict";
    var e = function () {
        this.$body = c("body")
    };
    
    e.prototype.createColumnChart = function (e, t, a, o) {
        var r = {
                fontName: "Trirong",
                height: 400,
                backgroundColor: {
                    fill: "transparent"
                },
                fontSize: 13,
                chartArea: {
                    left: "5%",
                    width: "90%",
                    height: 350
                },
                tooltip: {
                    textStyle: {
                        fontName: "Trirong",
                        fontSize: 14
                    }
                },
                hAxis: {
                    textStyle: {
                        color: "#98a6ad"
                    }
                },
                vAxis: {
                    title: a,
                    titleTextStyle: {
                        fontSize: 14,
                        italic: !1,
                        color: "#98a6ad"
                    },
                    gridlines: {
                        color: "transparent",
                        count: 10
                    },
                    baselineColor: "#98a6ad",
                    minValue: 0
                },
                legend: {
                    position: "top",
                    alignment: "center",
                    textStyle: {
                        fontSize: 13,
                        color: "#98a6ad"
                    }
                },
                colors: o
            },
            n = google.visualization.arrayToDataTable(t),
            i = new google.visualization.ColumnChart(e);
        return i.draw(n, r), i
    }, 
    
    e.prototype.createColumnStackChart = function (e, t, a, o) {
        var r = {
                fontName: "Trirong",
                height: 400,
                backgroundColor: {
                    fill: "transparent"
                },
                fontSize: 13,
                chartArea: {
                    left: "5%",
                    width: "90%",
                    height: 350
                },
                isStacked: !0,
                tooltip: {
                    textStyle: {
                        fontName: "Trirong",
                        fontSize: 14
                    }
                },
                hAxis: {
                    textStyle: {
                        color: "#98a6ad"
                    }
                },
                vAxis: {
                    title: a,
                    textStyle: {
                        color: "#98a6ad"
                    },
                    titleTextStyle: {
                        fontSize: 14,
                        italic: !1,
                        color: "#98a6ad"
                    },
                    gridlines: {
                        color: "transparent",
                        count: 10
                    },
                    baselineColor: "#98a6ad",
                    minValue: 0
                },
                legend: {
                    position: "top",
                    alignment: "center",
                    textStyle: {
                        fontSize: 13,
                        color: "#98a6ad"
                    }
                },
                colors: o
            },
            n = google.visualization.arrayToDataTable(t),
            i = new google.visualization.ColumnChart(e);
        return i.draw(n, r), i
    }, 
    
    e.prototype.createBarStackChart = function (e, t, a) {
        var o = {
                fontName: "Trirong",
                height: 400,
                backgroundColor: {
                    fill: "transparent"
                },
                fontSize: 13,
                chartArea: {
                    left: "5%",
                    width: "90%",
                    height: 350
                },
                isStacked: !0,
                tooltip: {
                    textStyle: {
                        fontName: "Trirong",
                        fontSize: 14
                    }
                },
                hAxis: {
                    textStyle: {
                        color: "#98a6ad"
                    },
                    baselineColor: "#98a6ad",
                    gridlines: {
                        color: "transparent",
                        count: 10
                    }
                },
                vAxis: {
                    textStyle: {
                        color: "#98a6ad"
                    }
                },
                legend: {
                    position: "top",
                    alignment: "center",
                    textStyle: {
                        fontSize: 13,
                        color: "#98a6ad"
                    }
                },
                colors: a
            },
            r = google.visualization.arrayToDataTable(t),
            n = new google.visualization.BarChart(e);
        return n.draw(r, o), n
    }, 
    
    e.prototype.createPieChart = function (e, t, a, o, r) {
        var n = {
            fontName: "Trirong",
            fontSize: 13,
            height: 400,
            backgroundColor: {
                fill: "transparent"
            },
            chartArea: {
                left: 50,
                width: "90%",
                height: "90%"
            },
            legend: {
                textStyle: {
                    fontSize: 13,
                    color: "#98a6ad"
                }
            },
            colors: a
        };
        o && (n.is3D = !0), r && (n.is3D = !0, n.pieSliceText = "label", n.slices = {
            2: {
                offset: .15
            },
            5: {
                offset: .1
            }
        });
        var i = google.visualization.arrayToDataTable(t),
            l = new google.visualization.PieChart(e);
        return l.draw(i, n), l
    }, 
    
    e.prototype.init = function () {
        var e = this,
            t = [
                ["Year", "Sales", "Expenses"],
                ["2010", 850, 120],
                ["2011", 745, 200],
                ["2012", 852, 180],
                ["2013", 1e3, 400],
                ["2014", 1170, 460],
                ["2015", 660, 1120],
                ["2016", 1030, 540]
            ];
        //e.createLineChart(c("#line-chart")[0], t, "Sales and Expenses", ["#297ef6", "#e52b4c"]), e.createAreaChart(c("#area-chart")[0], t, "Sales and Expenses", ["#297ef6", "#e52b4c"]);
        var a = [
            ["Year", "Desktop", "Tablets", "Mobiles"],
            ["2010", 850, 120, 200],
            ["2011", 745, 200, 562],
            ["2012", 852, 180, 521],
            ["2013", 1e3, 400, 652],
            ["2014", 1170, 460, 200],
            ["2015", 660, 1120, 562],
            ["2016", 1030, 540, 852]
        ];
        e.createColumnChart(c("#column-chart")[0], a, "Sales and Expenses", ["#297ef6", "#e52b4c", "#32c861"]);
        var o = [
            ["Year", "Sales", "Expenses"],
            ["2004", 1e3, 400],
            ["2005", 1170, 460],
            ["2006", 660, 1120],
            ["2007", 1030, 540]
        ];
        // e.createBarChart(c("#bar-chart")[0], o, ["#297ef6", "#32c861"]);
        var r = [
            ["Genre", "Fantasy & Sci Fi", "Romance", "Mystery/Crime", "General", {
                role: "annotation"
            }],
            ["2000", 20, 30, 35, 40, ""],
            ["2005", 14, 20, 25, 30, ""],
            ["2010", 10, 24, 20, 32, ""],
            ["2015", 15, 25, 30, 35, ""],
            ["2020", 16, 22, 23, 30, ""],
            ["2025", 12, 26, 20, 40, ""],
            ["2030", 28, 19, 29, 30, ""]
        ];
        e.createColumnStackChart(c("#column-stacked-chart")[0], r, "Sales and Expenses", ["#32c861", "#297ef6", "#e52b4c", "#ffa91c"]);
        var n = [
            ["Genre", "Fantasy & Sci Fi", "Romance", "Mystery/Crime", "General", {
                role: "annotation"
            }],
            ["2000", 20, 30, 35, 40, ""],
            ["2005", 14, 20, 25, 30, ""],
            ["2010", 10, 24, 20, 32, ""],
            ["2015", 15, 25, 30, 35, ""],
            ["2020", 16, 22, 23, 30, ""],
            ["2025", 12, 26, 20, 40, ""],
            ["2030", 28, 19, 29, 30, ""]
        ];
        e.createBarStackChart(c("#bar-stacked-chart")[0], n, ["#5553ce", "#297ef6", "#e52b4c", "#ffa91c"]);
        var i = [
            ["ประเภทรายรับ", "จำนวนรายได้"],
            ["รายได้แผ่นดิน", 11],
            ["รายได้กองทุน", 2],
            ["รายได้สุทธิ", 2]
        ];
        // e.createPieChart(c("#pie-chart")[0], i, ["#5553ce", "#297ef6", "#e52b4c", "#ffa91c", "#32c861"], !1, !1), 
        //e.createDonutChart(c("#donut-chart")[0], i, ["#5553ce", "#297ef6", "#e52b4c", "#ffa91c", "#32c861"]), 
        e.createPieChart(c("#pie-3d-chart")[0], i, ["#5553ce", "#297ef6", "#e52b4c", "#ffa91c", "#32c861"], !0, !1);
        var l = [
            ["Language", "Speakers (in millions)"],
            ["Assamese", 13],
            ["Bengali", 83],
            ["Gujarati", 46],
            ["Hindi", 90],
            ["Kannada", 38],
            ["Malayalam", 33]
        ];
        e.createPieChart(c("#3d-exploded-chart")[0], l, ["#5553ce", "#297ef6", "#e52b4c", "#ffa91c", "#32c861", "#353d4a"], !0, !0), c(window).on("resize", function () {
            e.createLineChart(c("#line-chart")[0], t, "Sales and Expenses", ["#4bd396", "#f5707a"]), 
            e.createAreaChart(c("#area-chart")[0], t, "Sales and Expenses", ["#4bd396", "#f5707a"]), 
            e.createColumnChart(c("#column-chart")[0], a, "Sales and Expenses", ["#4bd396", "#f5707a", "#3ac9d6"]), 
            e.createBarChart(c("#bar-chart")[0], o, ["#4bd396", "#f5707a"]), 
            e.createColumnStackChart(c("#column-stacked-chart")[0], r, "Sales and Expenses", ["#188ae2", "#4bd396", "#f9c851", "#f5707a", "#6b5fb5", "#3ac9d6"]), 
            e.createBarStackChart(c("#bar-stacked-chart")[0], n, ["#188ae2", "#4bd396", "#f9c851", "#f5707a", "#6b5fb5", "#3ac9d6"]), 
            e.createPieChart(c("#pie-chart")[0], i, ["#188ae2", "#4bd396", "#f9c851", "#f5707a", "#6b5fb5"], !1, !1), 
            //e.createDonutChart(c("#donut-chart")[0], i, ["#188ae2", "#4bd396", "#f9c851", "#f5707a", "#6b5fb5"]), 
            e.createPieChart(c("#pie-3d-chart")[0], i, ["#188ae2", "#4bd396", "#f9c851", "#f5707a", "#6b5fb5"], !0, !1), 
            e.createPieChart(c("#3d-exploded-chart")[0], l, ["#188ae2", "#4bd396", "#f9c851", "#f5707a", "#6b5fb5"], !0, !0)
        })
    }, c.GoogleChart = new e, c.GoogleChart.Constructor = e
}(window.jQuery),
function (e) {
    "use strict";
    google.load("visualization", "1", {
        packages: ["corechart"]
    }), google.setOnLoadCallback(function () {
        e.GoogleChart.init()
    })
}(window.jQuery);