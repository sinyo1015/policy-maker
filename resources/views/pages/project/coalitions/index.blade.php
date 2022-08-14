@extends("layouts.base")

@section("menu")
Pihak-Pihak
@endsection

@section("breadcrumb")
Peta Koalisi
@endsection

@section("title")
Peta Koalisi
@endsection

@section("current_page")
Peta Koalisi
@endsection


@section("contents")
<div class="card border-light shadow-sm components-section" x-data="__initAlpine()" x-init="initPosition()">
    <div class="card-header">
        <div class="float-end">
            <button @click="saveDiagram" class="btn btn-info text-white"><i class="fa fa-save"></i> Simpan Diagram</button>
        </div>
    </div>
    <div class="card-body">
        <div class="py-2">
            <center>
                <span>Klik dan tarik bagian biru yang ada disetiap kotak nama, kemudian lepas untuk menaruh kotak tersebut ditempat yang diinginkan</span>
            </center>
        </div>
        <center>
            <div id="map" style="width: 960px; height: 1000px;">

            </div>
        </center>
    </div>
</div>

@endsection

@push("header")
<style>
    svg text {
        -webkit-user-select: none;
        -moz-user-select: none;
        -ms-user-select: none;
        user-select: none;
    }
</style>
@endpush

@push("script")
<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
<script src="https://d3js.org/d3.v5.min.js"></script>
<script src="https://unpkg.com/alpinejs" defer></script>
<script src="https://html2canvas.hertzen.com/dist/html2canvas.min.js"></script>
<script>
    const SUPPORT_COLOR = "#52fa66",
        NEUTRAL_COLOR = "#ffffff",
        OPOSITION_COLOR = "#db4242";

    let svg = d3.select("#map")
        .append("svg")
        .attr("width", 960)
        .attr("height", 1000)
        .style('background-color', 'lightgrey');


    svg.append("circle")
        .attr("cx", 475)
        .attr("cy", 365)
        .attr("r", 200)
        .attr("fill", "none")
        .attr("stroke", "blue");
    svg.append("circle")
        .attr("cx", 475)
        .attr("cy", 365)
        .attr("r", 350)
        .attr("fill", "none")
        .attr("stroke", "red");

    let gLegend = svg.append("g");
    let boxLegend = gLegend.append("rect")
        .attr("width", 350)
        .attr("height", 200)
        .attr("fill", "white")
        .attr("x", 575)
        .attr("y", 750);
    gLegend.append("text")
        .text("Legenda")
        .attr("x", parseFloat(boxLegend.attr("x")) + 10)
        .attr("y", parseFloat(boxLegend.attr("y")) + 20)
        .attr("dy", ".35em");

    gLegend
        .append("rect")
        .attr("width", 45)
        .attr("height", 30)
        .attr("fill", "#00000")
        .attr("x", parseFloat(boxLegend.attr("x")) + 5)
        .attr("y", parseFloat(boxLegend.attr("y")) + 45);

    gLegend.append("rect")
        .attr("width", 35)
        .attr("height", 20)
        .attr("fill", SUPPORT_COLOR)
        .attr("x", parseFloat(boxLegend.attr("x")) + 10)
        .attr("y", parseFloat(boxLegend.attr("y")) + 50);
    gLegend.append("text")
        .text("Mendukung")
        .attr("x", parseFloat(boxLegend.attr("x")) + 60)
        .attr("y", parseFloat(boxLegend.attr("y")) + 60)
        .attr("dy", ".35em");

    gLegend
        .append("rect")
        .attr("width", 45)
        .attr("height", 30)
        .attr("fill", "#00000")
        .attr("x", parseFloat(boxLegend.attr("x")) + 5)
        .attr("y", parseFloat(boxLegend.attr("y")) + 95)

    gLegend.append("rect")
        .attr("width", 35)
        .attr("height", 20)
        .attr("fill", NEUTRAL_COLOR)
        .attr("x", parseFloat(boxLegend.attr("x")) + 10)
        .attr("y", parseFloat(boxLegend.attr("y")) + 100);


    gLegend.append("text")
        .text("Netral")
        .attr("x", parseFloat(boxLegend.attr("x")) + 60)
        .attr("y", parseFloat(boxLegend.attr("y")) + 110)
        .attr("dy", ".35em");

    gLegend
        .append("rect")
        .attr("width", 45)
        .attr("height", 30)
        .attr("fill", "#00000")
        .attr("x", parseFloat(boxLegend.attr("x")) + 5)
        .attr("y", parseFloat(boxLegend.attr("y")) + 145);

    gLegend.append("rect")
        .attr("width", 35)
        .attr("height", 20)
        .attr("fill", OPOSITION_COLOR)
        .attr("x", parseFloat(boxLegend.attr("x")) + 10)
        .attr("y", parseFloat(boxLegend.attr("y")) + 150)

    gLegend.append("text")
        .text("Oposisi")
        .attr("x", parseFloat(boxLegend.attr("x")) + 60)
        .attr("y", parseFloat(boxLegend.attr("y")) + 160)
        .attr("dy", ".35em");

    let barHeight = 30;
    let initial = 100;

    function __initAlpine() {
        return {
            datas: JSON.parse(`@json($data)`),

            saveDiagram() {
                html2canvas(document.querySelector("#map")).then(canvas => {
                    window.open(canvas.toDataURL('image/png'), "_blank");
                });
            },

            initPosition() {
                for (const item of Object.keys(this.datas)) {
                    for (const subItem of this.datas[item]) {
                        let color = function() {
                            switch (item) {
                                case "support":
                                    return SUPPORT_COLOR;
                                case "neutral":
                                    return NEUTRAL_COLOR;
                                case "oposition":
                                    return OPOSITION_COLOR;
                            }
                        };

                        let bar = svg.append("g")
                            .attr("transform", function(d, i) {
                                return "translate(0," + i * barHeight + ")";
                            });

                        let boxPosX = subItem.pos_x ?? initial;
                        let boxPosY = subItem.pos_y ?? initial;

                        let box = bar.append("rect")
                            .attr("x", parseFloat(boxPosX) - 85)
                            .attr("y", parseFloat(boxPosY) + 10)
                            .attr("width", 200)
                            .attr("fill", color())
                            .attr("height", barHeight - 1);

                        bar.append("rect")
                            .data([subItem.id])
                            .attr("x", parseFloat(boxPosX))
                            .attr("y", parseFloat(boxPosY))
                            .attr("width", 20)
                            .attr("fill", "blue")
                            .attr("height", 10)
                            .call(d3.drag().on("drag", function(d) {
                                d3.select(this).attr("x", d3.event.x).attr("y", d3.event.y);
                                box.attr("x", parseFloat(d3.event.x) - 85).attr("y", parseFloat(d3.event.y) + 10);
                                d3.select(d3.select(bar)._groups[0][0]._groups[0][0]).select("text").attr("x", d3.event.x - 80).attr("y", d3.event.y + 25);
                                // let parent = d3.select(this);
                                // console.log(d3.select(bar)._groups[0][0]._groups[0][0].getBoundingClientRect());
                            }).on("end", async function(l) {
                                // console.log(this);
                                // Ajax should get called in here as soon when drag is over
                                try {
                                    let response = await axios.post("{{route('project_coalitions.update_player_pos', [$id])}}", {
                                        _token: "{{csrf_token()}}",
                                        player_id: d3.select(this).data()[0],
                                        pos_x: d3.select(this).attr("x"),
                                        pos_y: d3.select(this).attr("y")
                                    });
                                } catch (err) {
                                    if (err.response.data?.data?.errors?.length > 0) {
                                        alert(err.response.data?.data?.errors[0]);
                                    } else {
                                        alert(err.response.data?.meta?.message);
                                    }
                                }
                            }));

                        bar.append("text")
                            .attr("x", parseFloat(box.attr("x")) + 5)
                            .attr("y", parseFloat(box.attr("y")) + 15)
                            .attr("dy", ".35em")
                            .attr("color", "white")
                            .text(subItem?.alt_name);

                        initial += 35;
                    }
                }
            }
        }
    }



    // for (let i = 0; i < 10; i++) {
    //     let bar = svg.append("g")
    //         .attr("transform", function(d, i) {
    //             return "translate(0," + i * barHeight + ")";
    //         });

    //     let box = bar.append("rect")
    //         .attr("x", initial)
    //         .attr("y", initial)
    //         .attr("width", 200)
    //         .attr("fill", "gray")
    //         .attr("height", barHeight - 1);

    //     bar.append("rect")
    //         .attr("x", parseFloat(initial) + 85)
    //         .attr("y", initial - 10)
    //         .attr("width", 20)
    //         .attr("fill", "blue")
    //         .attr("height", 10)
    //         .call(d3.drag().on("drag", function(d) {
    //             d3.select(this).attr("x", d3.event.x).attr("y", d3.event.y);
    //             box.attr("x", parseFloat(d3.event.x) - 85).attr("y", parseFloat(d3.event.y) + 10);
    //             d3.select(d3.select(bar)._groups[0][0]._groups[0][0]).select("text").attr("x", d3.event.x - 80).attr("y", d3.event.y + 25);
    //             // let parent = d3.select(this);
    //             // console.log(d3.select(bar)._groups[0][0]._groups[0][0].getBoundingClientRect());
    //         }).on("end", function(l) {
    //             // console.log(this);
    //             // Ajax should get called in here as soon when drag is over
    //         }));

    //     bar.append("text")
    //         .attr("x", parseFloat(box.attr("x")) + 10)
    //         .attr("y", parseFloat(box.attr("y")) + 10)
    //         .attr("dy", ".35em")
    //         .attr("color", "white")
    //         .text("Test");

    //     initial += 35;
    // }

    // svg.append("rect")
    //     .attr("x", 100)
    //     .attr("y", 400)
    //     .attr("width", 100)
    //     .attr("fill", "gray")
    //     .attr("stroke", "red")
    //     .attr("height", 30)
    //     .call(d3.drag().on("drag", function(d){
    //         d3.select(this).attr("x", d3.event.x).attr("y", d3.event.y);
    //     }));
    // let low = svg.append("rect")
    //     .attr("x", 110)
    //     .attr("y", 410)
    //     .attr("width", 100)
    //     .attr("height", 30)
    //     .attr("fill", "gray")
    //     .attr("stroke", "blue")
    //     .call(d3.drag().on("drag", function(d){
    //         d3.select(this).attr("x", d3.event.x).attr("y", d3.event.y);
    //     }));
    // low.append("p").text("Test");
</script>
@endpush