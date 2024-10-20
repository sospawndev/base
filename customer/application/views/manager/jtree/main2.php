<link href="assets/familytree/Themes/smoothness/jquery-ui-1.10.4.custom.min.css" rel="stylesheet" />
<link href="assets/familytree/css/jHTree.css" rel="stylesheet" />
<link href="assets/familytree/css/subtree.css" rel="stylesheet" />
<script src="assets/familytree/js/jquery-1.10.2.js"></script>
<script src="assets/familytree/js/jquery-ui-1.10.4.custom.min.js"></script>
<script src="assets/familytree/js/jQuery.jHTree.js"></script>
<style type="text/css">
.tree
{
	margin-left: 25%;	
}
.zmrcntr
{
	display:none;	
}

</style>

<div class="card card-style overflow-visible mt-5">
  <div class="card-body">
         <div id="tree">
    
        </div>
  </div>      
</div>

 <script type="text/javascript">
        $(function () {
           
            $("#tree").jHTree({
                callType: 'url',
                url: 'assets/familytree/data/myJsonFile.json',
                nodeDropComplete: function (event, data) {
                    //----- Do Something @ Server side or client side -----------
                    //alert("Node ID: " + data.nodeId + " Parent Node ID: " + data.parentNodeId);
                    //-----------------------------------------------------------
                }
            });
            //-------------------
            //var jsonStructureObject = [{
            //    head: 'A',
            //    id: 'aa',
            //    contents: 'A Contents',
            //    children: [
            //        {
            //            head: 'A-1',
            //            id: 'a1',
            //            contents: 'A-1 Contents',
            //            children: [
            //                { head: 'A-1-1', id: 'a11', contents: 'A-1-1 Contents' }
            //            ]
            //        },
            //        {
            //            head: 'A-2',
            //            id: 'a2',
            //            contents: 'A-2 Contents',
            //            children: [
            //                { head: 'A-2-1', id: 'a21', contents: 'A-2-1 Contents' },
            //                { head: 'A-2-2', id: 'a22', contents: 'A-2-2 Contents' }
            //            ]
            //        }
            //    ]
            //}];
            ////-----------
            //$("#tree").jHTree({
            //    callType: 'obj',
            //    structureObj: jsonStructureObject
            //});
        });
    </script>

    <style type="text/css">
        #themes {
            font-size: 1.2em;
        }

        #set {
            border: 2px solid #ddd;
            padding: 2px;
            background: #444;
            width: 350px;
            height: 30px;
        }

            #set a {
                margin: 2px;
                border: 1px solid #444;
                float: left;
            }

                #set a:hover {
                    border-color: #fff;
                }
    </style>

    <script type="text/javascript">
        $(function () {
            $('#themes a').click(function () {
                var theme = $(this).attr('href');
                $('head').append('<link href="' + theme + '" rel="Stylesheet" type="text/css" />');
                return false;
            });

        });
    </script> 
       
       
       
      