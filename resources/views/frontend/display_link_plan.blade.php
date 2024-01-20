@extends('layouts.master')
@section('meta_script')
    <meta content="width=device-width, initial-scale=1.0" name="viewport">
    <title>Delivery In Hour</title>
    <script src="https://unpkg.com/gojs/release/go-debug.js"></script>
    <style>
        @media (min-width:768px) {
            #myDiagramDiv {
                width: 1500px;
                height: 680px;
                display: table;
                margin: 0 auto;
                margin-top: 120px
            }

        }
        @media (max-width:767px) {
            #myDiagramDiv{
                width: 354px;
                height: 450px;
                display: table;
                position: relative;
                -webkit-tap-highlight-color: rgba(255, 255, 255, 0);
                cursor: auto;
                margin-top: 116px;
                margin-left: 8px;
            }
        }

    </style>
@endsection

@section('content')

    <div class="container-fluid">
        <div id="myDiagramDiv" style=""></div>
    </div>
    <br>
    <div class="container">
        <div class="mobile-center col-lg-2 col-md-2 col-sm-2 col-xs-2" style="display: table;margin: 0 auto">
            <a href="{{url('/gmapsdata')}}" class="form-control index-footer set-right text-center" id="next-button">Next <i class="fa fa-arrow-right"></i></a>
        </div>
        <div class="mobile-center col-lg-2 col-md-2 col-sm-2 col-xs-2" style="display: table;margin: 0 auto">
            <a href="{{url('/edit_index/'.$pid)}}" class="form-control index-footer set-right text-center" id="edit-button">Edit</a>
        </div>
    </div>
@endsection

@section('main_script')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery.blockUI/2.70/jquery.blockUI.js"></script>
    <script>
        var jqxhr = {abort: function () {}};
        $(document).ready(function () {
            fetch_data();
            function fetch_data()
            {
                jqxhr.abort();
                jqxhr=$.ajax({
                    beforeSend: function(){
                        block_ui();
                        init();
                    },
                    success:function()
                    {
                        unblock_ui();
                    }
                });
            }

            function init() {
                var $=go.GraphObject.make;
                myDiagram=$(go.Diagram,"myDiagramDiv", {
                    hoverDelay: 200,  // controls how long to wait motionless (msec) before showing Adornment
                    "undoManager.isEnabled": true  // enable undo & redo
                });
                var nodeDataArray={!! $ndadata !!}
                var linkDataArray={!! $linkdata !!};

                myDiagram.model=new go.GraphLinksModel(nodeDataArray,linkDataArray);
                var nodeHoverAdornment =
                    $(go.Adornment, "Spot",
                        {
                            background: "transparent",
                            // hide the Adornment when the mouse leaves it
                            mouseLeave: function(e, obj) {
                                var ad = obj.part;
                                ad.adornedPart.removeAdornment("mouseHover");
                            }
                        },

                        $(go.Placeholder,
                            {

                                background: "transparent",  // to allow this Placeholder to be "seen" by mouse events
                                isActionable: true,  // needed because this is in a temporary Layer

                                click: function(e, obj) {
                                    var node = obj.part.adornedPart;
                                    node.diagram.select(node);
                                },
                            }),

                        $(go.Panel, "Table",

                            { alignment: go.Spot.Top},
                            { defaultAlignment: go.Spot.Left },
                            { row: 2, columnSpan: 2 },
                            new go.Binding("itemArray", "items"),
                            {
                                itemTemplate:
                                    $(go.Panel, "TableRow",
                                        { background: "#D5D5D5"},

                                        $(go.TextBlock,     // group title near top, next to button
                                            { font: "Bold 10pt Sans-Serif",stroke: "black",margin : 15,wrap: go.TextBlock.WrapFit, isMultiline: true, width: 300,},
                                            new go.Binding("text", "")),
                                    )
                            }
                        )
                    );

                myDiagram.groupTemplate =
                    $(go.Group, "Auto",
                        // declare the Group.layout:
                        { layout: $(go.LayeredDigraphLayout,
                                { direction: 0, columnSpacing: 0 }) },
                        $(go.Shape, "RoundedRectangle",  // surrounds everything
                            { parameter1: 5, fill: "white" }),
                        $(go.Panel, "Vertical",  // position header above the subgraph
                            $(go.TextBlock,     // group title near top, next to button
                                { font: "Bold 12pt Sans-Serif", background: "rgba(128,128,128,0.33)" },
                                new go.Binding("stroke", "color",
                                    // dark nodes use white text, light nodes use dark text
                                    function (c) { return go.Brush.isDark(c) ? "white" : "black"; }),
                                {margin:8},
                                new go.Binding("text", "key")),

                            //
                            { // show the Adornment when a mouseHover event occurs
                                mouseHover: function(e, obj) {
                                    var node = obj.part;
                                    nodeHoverAdornment.adornedObject = node;
                                    node.addAdornment("mouseHover", nodeHoverAdornment);

                                }
                            },
                            $(go.Placeholder),
                        )
                    );
                myDiagram.nodeTemplate =
                    $(go.Node, "Auto",
                        $(go.Shape,"RoundedRectangle", { fill: "white" },
                            new go.Binding("fill","color")
                        ),

                        $(go.Panel, "Table",
                            { margin: 0.5 },
                            $(go.RowColumnDefinition, { row: 0}),
                            $(go.TextBlock, { column: 0, margin: new go.Margin(10, 10, 10, 10) , stroke: "white",font: "Bold 12pt Sans-Serif"},
                                new go.Binding("text", "key")
                            ),
                            $("PanelExpanderButton", { column: 1, background: "lightgray", alignment: go.Spot.Right}),

                            $(go.Panel, "Table",
                                { defaultAlignment: go.Spot.Left },
                                { name: "COLLAPSIBLE", row: 1, columnSpan: 2 },
                                new go.Binding("itemArray", "items"),
                                {
                                    itemTemplate:
                                        $(go.Panel, "TableRow",

                                            $(go.TextBlock,     // group title near top, next to button
                                                { font: "Bold 10pt Sans-Serif"},
                                                new go.Binding("stroke", "color",
                                                    // dark nodes use white text, light nodes use dark text
                                                    function (c) { return go.Brush.isDark(c) ? "white" : "black"; }),
                                                new go.Binding("text", "")),
                                            // $(go.TextBlock, new go.Binding("text", ""))
                                        )
                                }
                            ),

                        )
                    );



                myDiagram.linkTemplate=
                    $(go.Link,
                        $(go.Shape,{strokeWidth:3},
                            new go.Binding("stroke","color")
                        ),
                        $(go.Shape,{toArrow:"standard",stroke:null},
                            new go.Binding("fill","color")
                        ),
                    );
            }


        });
        function block_ui()
        {
            $.blockUI({ message: '<img src="{{url('public/images/loader.gif')}}" />',
                css: {
                    border: 'none',
                    '-webkit-border-radius': '10px',
                    '-moz-border-radius': '10px',
                    backgroundColor: 'unset',
                }});
        }

        function unblock_ui()
        {
            $.unblockUI();
        }
    </script>

@endsection



