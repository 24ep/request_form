<?php 

session_start();

$block_id = $_POST['block_id'];

date_default_timezone_set("Asia/Bangkok");

$con= mysqli_connect("service-gate-cds-omni-service-gate.a.aivencloud.com","avnadmin","AVNS_lAORtpjxYyc9Pvhm5O4","all_in_one_project","10628") or die("Error: " . mysqli_error($con));

mysqli_query($con, "SET NAMES 'utf8' ");

//pring folder

$query = "SELECT id, brand, body, version, create_date, update_date, update_by, dri_id

FROM all_in_one_project.brand_editor

where  id =   ".$block_id."

" or die("Error:" . mysqli_error($con));

$result = mysqli_query($con, $query);



while($row = mysqli_fetch_array($result)) {

  $body = $row['body'];

  $id = $row['id'];

}

?>

<div class="container-fluid shadow-sm" style="border-radius: 10px;border: 1px solid #f4f4f4;padding: 30px;background: white;">

    <div id="editorjs"></div>

</div>



<script>

// first define the tools to be made avaliable in the columns

var column_tools = {

    header: Header,

    alert: Alert,

    paragraph: Paragraph,

    delimiter: Delimiter

}

// editor.destroy();

var ImageTool = window.ImageTool;

var editor = new EditorJS({



        placeholder: 'Let`s write commitment and brand guideline together !',

        onReady: () => {

            console.log('Editor.js is ready to work!');

            new DragDrop(editor);



        },

        onChange: (api, event) => {

            //console.log('<?php //echo $_SESSION['username'];?>have been updated a content in brand note', event)

            editor.save().then((outputData) => {

                // console.log('Article data: ', outputData)

                outputData = JSON.stringify(outputData, null, 4);

                update_brand_note(outputData, '<?php echo $id; ?>');

            }).catch((error) => {

                console.log('Saving failed: ', error)

            });

        },

        holder: 'editorjs',

        tools: {

            columns: {

                class: editorjsColumns,

                config: {

                    tools: column_tools, // IMPORTANT! ref the column_tools

                }

            },

            header: {

                class: Header,

                config: {

                    placeholder: 'Enter a header',

                    levels: [2, 3, 4],

                    defaultLevel: 3

                }

            },

            list: {

                class: List,

                inlineToolbar: true,

                config: {

                    defaultStyle: 'unordered'

                }

            },

            list: {

                class: NestedList,

                inlineToolbar: true,

            },

            checklist: {

                class: Checklist,

                inlineToolbar: true,

            },

            table: {

                class: Table,

                inlineToolbar: true,

                config: {

                    rows: 2,

                    cols: 3,

                },

            },

            paragraph: {

                class: Paragraph,

                inlineToolbar: true,

            },

            code: CodeTool,

            embed: Embed,

            warning: Warning,

            alert: Alert,

            delimiter: Delimiter,

            underline: Underline,

            code: CodeTool,

            // linkTool: {

            //     class: LinkTool,

            //     config: {

            //         endpoint: 'http://service-gate-cds-omni-service-gate.a.aivencloud.com:8008/fetchUrl', // Your backend endpoint for url data fetching,

            //     }

            // },

            // raw: RawTool,

            marker: {

                class: Marker,

                shortcut: 'CMD+SHIFT+M'

            },



            image: {

                class: ImageTool,

                config: {

                    endpoints: {

                        byFile: 'https://phpstack-1223668-4355262.cloudwaysapps.com/action/action_endpoint_uploadfiles.php', // Your backend file uploader endpoint

                        byUrl: 'https://phpstack-1223668-4355262.cloudwaysapps.com/action/action_endpoint_uploadfiles.php', // Your endpoint that provides uploading by Url

                    }

                }

            },

        },



        <?php if($body<>""){

            echo ' data: '.$body;

        }?>



    }



);

// function update_brand_note(dataoutput,brand){

//     $.post("../action/action_update_brand_note.php", {

//         dataoutput: dataoutput,

//         brand : brand

//     }, function(data) {

//         // $('#get_list_job_update').html(data);

//     });

// }



</script>

