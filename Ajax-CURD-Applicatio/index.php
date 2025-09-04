<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Ajax Application</title>
</head>
<style>
    body
    {
        font-family: arial, sans-serif;
        background: #f2f2f2;
        margin: 0;
        padding: 0;
    }
    .header
    {
        background: #ffcc80;
        padding: 15px;
        text-align: center;
        font-size: 22px;
        font-weight: bold;
        color: #333;
    }
    .form-box
    {
        background: #4dd0e1;
        padding: 50px;
        display: flex;
        justify-content: center;
        align-items: center;
        gap: 30px;
        flex-wrap: wrap;
        text-align: center;
    }
    .form-box input[type="text"]
    {
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 4px;
        width: 180px;
    }
    .form-box button
    {
        padding: 8px 15px;
        border: none;
        background: #00796b;
        color: #fff;
        border-radius: 4px;
        cursor: pointer;
        font-weight: bold;
    }
    .form-box button:hover
    {
        background: #004d40;
    }
    .table-container
    {
        width: 90%;
        margin: 20px auto;
        overflow-x: auto;
        box-shadow: 0px 2px 5px rgba(0, 0, 0, 0.2);
        background: #fff;
        border-radius: 6px;
    }
    table
    {
        width: 100%;
        border-collapse: collapse;
        min-width: 400px;
    }
    table th,table td
    {
        border: 1px solid #ddd;
        padding: 10px;
        text-align: center;
        font-size: 14px;
    }
    table th
    {
        background: #29b6f6;
        color: #fff;
    }
    .action-btn
    {
        padding: 5px 10px;
        border: none;
        border-radius: 4px;
        cursor: pointer;
        font-size: 13px;
    }
    .edit
    {
        background: #ffb300;
        color: #fff;
        margin-right: 5px;
    }
    .delete
    {
        background: #e53935;
        color: #fff;
    }
    .edit:hover
    {
        background: #f57c00;
    }
    .delete:hover
    {
        background: #b71c1c;
    }
    @media(max-width:600px)
    {
        .header
        {
            font-size: 18px;
            padding: 10px;
        }
        .form-box
        {
            flex-direction: column;
        }
        .form-box input[type="text"]
        {
            width: 100%;
            max-width: 280px;
        }
        .form-box button
        {
            width: 100%;
            max-width: 150px;
        }
        table th, table td
        {
            font-size: 12px;
            padding: 8px;
        }
        .action-btn
        {
            padding: 4px 8px;
            font-size: 12px;
        }
    }
    #success-message
    {
        background: #DEF1D8;
        color: green;
        padding: 10px;
        margin: 10px;
        display: none;
        position: absolute;
        right: 500px;
        top: 50px;
    }
    #error-message
    {
        background: #EFDCDD;
        color: red;
        padding: 10px;
        margin: 10px;
        display: none;
        position: absolute;
        right: 500px;
        top: 50px;
    }
    @media (max-width:600px)
    {
        #success-message,#error-message
        {
            top: 40px;
            left:50%;
            right: 250px;
            transform: translateX(-50%);
            width: calc(50% - 40px);
            max-width: none;
        }
    }
    .delete-btn
    {
        background: red;
        color: #fff;
        border: 0;
        padding: 4px 10px;
        border-radius: 3px;
        cursor: pointer;
        height: 30px;
        width: 60px;
    }
    .delete-btn1
    {
        background: red;
        color: #fff;
        border: 0;
        padding: 4px 10px;
        border-radius: 3px;
        cursor: pointer;
        height: 30px;
        width: 60px;
    }
    .edit-btn
    {
        background: green;
        color: #fff;
        border: 0;
        padding: 4px 10px;
        border-radius: 3px;
        cursor: pointer;
        height: 30px;
        width: 60px;
    }
    #model
    {
        background: rgba(0, 0, 0, 0.7);
        position: fixed;
        left: 0;
        top: 0;
        width: 100%;
        height: 100%;
        z-index: 100;
        display: none;
    }
    #model-form
    {
        background: #fff;
        width: 40%;
        position: relative;
        top: 20%;
        left: calc(50% - 20%);
        padding: 15px;
        border-radius: 4px;
    }
    #model-form h2
    {
        margin: 0 0 15px;
        padding-bottom: 10px;
        border-bottom: 2px solid #000;

    }
    #close-btn
    {
        background: red;
        color: white;
        width: 30px;
        height: 30px;
        line-height: 30px;
        text-align: center;
        border-radius: 50px;
        position: absolute;
        top: -15px;
        right: -15px;
        cursor: pointer;
    }
    #pagination 
    {
        text-align: center;
        margin: 20px 0;
    }
    #pagination a
    {
        display: inline-block;
        padding: 8px 14px;
        margin:0 4px;
        border:1px solid #ddd;
        border-radius: 6px;
        background: #f8f9fa;
        color: #333;
        text-decoration: none;
        font-size: 14px;
        font-weight: 500;
        transition: all 0.2 ease-in-out;
    }
    #pagination a:hover
    {
        background: #007bff;
        color: #fff;
        border-color: #007bff;
        transform: translateY(-2px);
        box-shadow: 0 2px 5px rgba(0, 0, 0, 0.15);
    }
    #pagination a.active
    {
        background: #28a745;
        color: #fff;
        border-color: #28a745;
        cursor: default;
        box-shadow: 0 2px 6px rgba(0, 0, 0, 0.2);
    }
    #pagination a.disabled
    {
        background: #e9ecef;
        color: #999;
        border-color: #ddd;
        cursor: not-allowed;
        box-shadow: none;
    }
    body
    {
        margin: 0;
        height: 100vh;
        overflow: hidden;
        font-family: 'Poppins',sans-serif;
    }
    #loader
    {
        width: 100%;
        height: 100%;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
        background: linear-gradient(270deg, #ff00ff, #00e1ff, #fffb00, #00ff7f);
        background-size: 800% 800%;
        animation: gradientMove 12s ease infinite;
        text-align: center;
        padding: 20px;
        box-sizing: border-box;
    }
    @keyframes gradientMove
    {
        0% {background-position: 0% 50%;}
        50% {background-position: 100% 50%;}
        100%{background-position: 0% 50%;}
    }
    .loader-text
    {
        font-size: clamp(22px,5vw,42px);
        font-weight: 700px;
        color: #fff;
        letter-spacing: 2px;
        text-shadow: 0 0 20px #000, 0 0 40px #ff00ff, 0 0 60px #00e1ff;
        animation: zoomFlip 2s ease-in-out infinite alternate;
        line-height: 1.4;
    }
    .loader-text span
    {
        display: block;
    }
    @keyframes zoomFlip
    {
        0% {transform: scale(0.9) rotateX(0deg);}
        100% {transform: scale(1.1) rotateX(360deg);}
    }
    .progress-container
    {
        margin-top: 30px;
        width: 80%;
        max-width: 320px;
        height: 8px;
        background: rgba(255,255,255,0.2);
        border-radius: 10px;
        overflow: hidden;
    }
    .progress-bar
    {
        width: 0%;
        height: 100%;
        background: linear-gradient(90deg, #ff00ff, #00e1ff, #00ff7f);
        border-radius: 10px;
        animation: load 5s linear forwards;
    }
    @keyframes load
    {
        from {width: 0%;}
        to {width: 100%;}
    }
    #main
    {
        display: none;
        overflow: auto;
        height: 100%;
        background: #111;
        color: black;
        text-align: center;
        animation: fadeln 1s ease-in-out;
    }
    @keyframes fadeln
    {
        from {opacity: 0; transform: scale(0.9);}
        to {opacity: ; transform: scale(1);}
    }
</style>
<body>
    <div id="loader">
        <div class="loader-text">
            Developed By <span>Mohd Tanzeem</span>
        </div>
        <div class="progress-container">
            <div class="progress-bar"></div>
        </div>
    </div>
    <div id="main">
        <div class="header">
            <h1>PHP & AJAX CURD OPERATION APPLICATION</h1>
        </div>

        <div class="form-box">
            <form id="add-form">
                <input type="text" id="firstname" placeholder="Enter The First Name">
                <input type="text" id="lastname" placeholder="Enter The Last Name">
                <input type="text" id="city" placeholder="Enter The City"> 
                <input type="text" id="contact" placeholder="Enter The Contact">
                <button id="save-button">Save</button>
            </form>

            <div id="search-bar">
                <label>Search:</label>
                <input type="text" name="search" id="search" autocomplete="off">
            </div>
        </div>

        <div class="table-container">
            <div id="table-data"> 
            </div>
        </div>
        <div id="error-message"></div>
        <div id="success-message"></div>
        <div id="model">
            <div id="model-form">
                <h2>Edit Form</h2>
                <table cellpadding="10px" width="100%"> 
                
                </table>
                <div id="close-btn">X</div>
            </div>
        </div>
    </div>
    <script src="jquery-com.js"></script>
    <script type="text/javascript">
        $(document).ready(function()
        {
            //Load Table All Records
            function loadTable()
            {
                $.ajax(
                {
                    url: "ajax-load.php",
                    type: "POST",
                    success: function(data)
                    {
                        $("#table-data").html(data);
                    },
                    error: function(xhr,status,error)
                    {
                        alert("Ajax Error : "+error);
                    }
                });
            }
            loadTable();
            //Insert The Records In Table
            $("#save-button").on("click",function(e)
            {
                e.preventDefault();
                var first_Name=$("#firstname").val();
                var last_Name=$("#lastname").val();
                var city=$("#city").val();
                var contact=$("#contact").val();
                if(first_Name=="" || last_Name=="" || city=="" || contact=="")
                {
                    $("#error-message").html("All Fields Are Required...").slideDown();
                    $("#success-message").slideUp();
                }
                else
                {
                    $.ajax(
                    {
                        url: "ajax-insert.php",
                        type: "POST",
                        data: {fname:first_Name,lname:last_Name,city:city,contact:contact},
                        success: function(data)
                        {
                            if(data==1)
                            {
                                loadTable();
                                $("#add-form").trigger("reset");
                                $("#success-message").html("Record Inserted Successfully...").slideDown();
                                $("#error-message").slideUp();
                            }
                            else
                            {
                                $("#error-message").html("Can't Save Record...").slideDown();
                                $("#success-message").slideUp();
                            }
                        }
                    });
                }
            });
            //Delete The Records In Table
            $(document).on("click",".delete-btn",function()
            {
                if(confirm("Do You Really Want To Delete This Record?"))
                {
                    var studentId=$(this).data("id");
                    var element=this;
                    $.ajax(
                    {
                        url: "ajax-delete.php",
                        type: "POST",
                        data: {id:studentId},
                        success: function(data)
                        {
                            if(data==1)
                            {
                            loadTable();
                                $(element).closest("tr").fadeOut();
                            }
                            else
                            {
                                $("#error-message").html("All Fields Are Required...").slideDown();
                                $("#success-message").slideUp();
                            }
                        }
                    });
                }
            });
            //Update The Records In Table And Show Model Box
            $(document).on("click",".edit-btn",function()
            {
                $("#model").show();
                var stdId=$(this).data("id");
                $.ajax(
                {
                    url: "ajax-update.php",
                    type: "POST",
                    data: {s_Id:stdId},
                    success: function(data)
                    {
                        $("#model-form table").html(data); 
                        loadTable();
                    }
                });
            });
            //Hidden The Model Box
            $("#close-btn").on("click",function(e)
            {
                $("#model").hide();
            });
            //Update Records In The Table
            $(document).on("click","#edit-submit",function()
            {
                var id=$("#edit-id").val();
                var first=$("#edit-firstname").val();
                var last=$("#edit-lastname").val();
                var city=$("#edit-city").val();
                var contact=$("#edit-contact").val();
                $.ajax(
                {
                    url: "ajax-update-form.php",
                    type: "POST",
                    data: {std_Id:id,firstName:first,lastName:last,c_city:city,c_contact:contact},
                    success: function(data)
                    {
                        if(data==1)
                        {
                            $("#model").hide();
                            loadTable();
                        }
                    }
                });
            });
            $(document).on("click","#edit-reset1",function()
            {
                $("#edit-id").val("");
                $("#edit-firstname").val("");
                $("#edit-lastname").val("");
                $("#edit-city").val("");
                $("#edit-contact").val("");
               
            });
            //Live Search In The Table
            $("#search-bar").on("keyup",function()
            {
                var search_value=$("#search").val();
                $.ajax(
                {
                    url: "ajax-live-search.php",
                    type: "POST",
                    data: {search:search_value},
                    success: function(data)
                    {
                        $("#table-data").html(data);
                        loadTable();
                    }
                });
            });
        });
        $(document).ready(function()
        {
            function loadTable(page)
            {
                $.ajax(
                {
                    url: "ajax-pagination.php",
                    type: "POST",
                    data: {page_no:page},
                    success: function(data)
                    {
                        $("#table-data").html(data);
                        loadTable();
                    }
                });
            }
            loadTable();
            $(document).on("click","#pagination a",function(e)
            {
                e.preventDefault();
                var page_id=$(this).attr("Id");
                loadTable(page_id);
                loadTable();
            });
        });
    </script>
    <script>
        setTimeout(()=>
        {
            document.getElementById("loader").style.display="none";
            document.getElementById("main").style.display="block";
            // document.body.style.height="7000px";
        },5000);
    </script>
</body>
</html>
