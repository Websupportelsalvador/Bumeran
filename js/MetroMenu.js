// Metro Menu v3.2 (3 level JavaScript Menu)
// Autor: Klerith
// Page:  http://codecanyon.net/user/klerith
// Contact me from CodeCanyon site.
// :) Thank you for your support

// ==============================
// V.3.1, bug fixes, added a new propertie.
// mouseouttooltip: true
// ==============================




var MetroMenuIsOpen = 0;

// This function Close the menu.
// You can call it anywhere from a JavaScript function
function CloseMetroMenu()
{
    MetroMenuIsOpen = 0;
    $(".MetroToolTip").removeClass("fast").addClass("fadeOut");
    $(".MetroMenuBox").addClass("fadeOut fast").delay(200).queue(function()
    {
        $(this).remove();
        $(".MetroToolTip").remove();
    });
}


(function ($) 
{
    $.MetroMenu = function (settings,callback) 
    {
        var MainOptions = 0;
        var MenuID = 1;
        var MenuLoad = 0;

        var ImInMenuSubMenu= 0;

        var MenuAnimarPaso1 = -1;
        var MenuAnimarPaso2 = -1;
        var SubMenuPointer = 0;

        var MiddlePoint = 0;
        var MiddlePointDone = false;
        var SubMenuOpen = false;

        var CurrentSubMenuOptions = 0;
        var MouseOverMenu = 0;

        settings = $.extend({
            animation: "fadeInLeft",
            position: "left",
            withtooltip: true,
            mouseouttooltip: true,
            backicon: "static/img/back.png",
            closeonclick: true,
            divholderid: undefined,
            escclose: true,
            items: []
        }, settings);


        if (MetroMenuIsOpen == 1)
        {
            $(".MetroMenuBox").remove();
            $(".MetroToolTip").remove();
            
        }



        $(window).unbind("resize")
        MetroMenuIsOpen = 1;


        MainOptions = settings.items.length;
        MenuID = MainOptions - 1;

        settings.position = settings.position.toLowerCase();

        // If has the divholderid
        if(settings.divholderid != undefined)
        {
            settings.position = "top";
        }

        // Create the space for the MetroMenuBox that holds the options
        if(settings.position == "top" || settings.position == "bottom")
        {
            var MainContainer  = '<div align="center" class="MetroMenuBox animated fadeIn fast" style="background-color: '+ settings.color1 +';">';
                MainContainer += '<div align="center" class="MenuOptionBar animated fadeIn fast" id="MenuOptionBar">';
                MainContainer += '</div>';
                MainContainer += '<div align="center" class="SubMenuOptionBar animated fadeIn fast" id="SubMenuOptionBar">';
                MainContainer += '</div>';
                MainContainer += '</div>';

                if(settings.divholderid !=undefined)
                {
                    if(settings.divholderid.indexOf("#")<0)
                    {
                        settings.divholderid = "#" + settings.divholderid;
                    }
                    $(settings.divholderid).append(MainContainer);
                }
                else
                {
                    $("body").append(MainContainer);
                }
                

        }
        else
        {
            var MainContainer  = '<div class="MetroMenuBox animated fadeIn fast" style="background-color: '+ settings.color1 +';">';
                MainContainer += '<div class="MenuOptionBar animated fadeIn fast" id="MenuOptionBar">';
                MainContainer += '</div>';
                MainContainer += '<div class="SubMenuOptionBar animated fadeIn fast" id="SubMenuOptionBar">';
                MainContainer += '</div>';
                MainContainer += '</div>';

                $("body").append(MainContainer);
                $(".MetroMenuBox").show().css("display","table");
                $(".MetroMenuBox").css("text-align","center");
        }
        

        // Create the space for the ToolTip box
        var ToolTipBox  = '<div class="MetroToolTip" style="background-color: '+ settings.color1 +';">';
            ToolTipBox += '<div class="ToolImagen animated fast">';
            ToolTipBox += '<img src="" id="ActiveIcon">';
            ToolTipBox += '<img src="" id="ActiveIconSub1">';
            ToolTipBox += '</div>';
            ToolTipBox += '<div class="ToolText animated fast">';
            ToolTipBox += '<span id="toolTitle">Programas</span>';
            ToolTipBox += '<span id="toolText"></span>';
            ToolTipBox += '</div>';
            ToolTipBox += '</div>';

            $("body").append(ToolTipBox);




        // Position
        MenuPositionFix();
        
        AnimationFix();

        // Menu Options
        var OptionMenu =""
        for (var i = 0; i < MainOptions; i++) 
        {
            var SubMenuOptions = " ";
            var SubMenuOptionsNumber = 0;
            if(settings.items[i].items != undefined)
            {
                if(settings.items[i].items.length ==1)
                {
                    SubMenuOptions = "1 option";
                    SubMenuOptionsNumber = 1;
                }
                else
                {
                    SubMenuOptions = settings.items[i].items.length + " options"
                    SubMenuOptionsNumber = settings.items[i].items.length;
                }
            }
            
            if(settings.items[i].link == undefined)
            {
                OptionMenu += '<div class="MenuOption" id="MenuOption'+i+'" picture="'+ settings.items[i].icon +'" optionname="'+ settings.items[i].name +'" submenuitems="'+ SubMenuOptions +'" SubMenuOptionsNumber="'+ SubMenuOptionsNumber +'" menuoptionI="'+ i +'">';
                OptionMenu += '<img src="'+ settings.items[i].icon +'" class="MenuIcon" OptionName="'+ settings.items[i].name +'">';
                OptionMenu += '<span class="MenuOptionText">'+ settings.items[i].name +'</span>';
                OptionMenu += '</div>';
            }
            else
            {
                OptionMenu += '<a href ="'+ settings.items[i].link +'" style="border-style: none">';
                OptionMenu += '<div class="MenuOption" id="MenuOption'+i+'" picture="'+ settings.items[i].icon +'" optionname="'+ settings.items[i].name +'" submenuitems="'+ SubMenuOptions +'" SubMenuOptionsNumber="'+ SubMenuOptionsNumber +'" menuoptionI="'+ i +'">';
                OptionMenu += '<img src="'+ settings.items[i].icon +'" class="MenuIcon" OptionName="'+ settings.items[i].name +'" style="border-style: none">';
                OptionMenu += '<span class="MenuOptionText" border="none">'+ settings.items[i].name +'</span>';
                OptionMenu += '</div>';
                OptionMenu += '</a>';
            }

        };


        $("#MenuOptionBar").append(OptionMenu);



        // SubMenu Position
        SubMenuPosition();
        MenuRaiz();

        // Automatic resize depending on the MenuOption Number
        // MenuOption Normal 100px 
        if(settings.position == "left" || settings.position == "right")
        {
            MenuResize();
        }
        else
        {
            MenuResizeTopBottom();
        }
            
        
        // Mouse Hover color
        $('.MenuOption').hover(function()
        {
            var ThisID = $(this).attr('id');
            $("#"+ThisID).css("background-color", settings.color2);
        },
        function()
        {
            var ThisID = $(this).attr('id');
            $("#"+ThisID).css("background-color", "transparent");
        });

        $('.MetroMenuBox').hover(function(){
            MouseOverMenu = 1;
        },function(){
            MouseOverMenu = 0;
        });

      $("div.MetroMenuBox").bind("mouseleave",function(){

          var Bodywidth = $(window).width();
          if(Bodywidth >= 601 && settings.withtooltip == true)
          {

                $(".MetroToolTip").removeClass("animated fadeIn fast").addClass("animated fadeOut fast");

          } 

        });

        $(".MenuOption").bind('mouseover', function(){

            var Bodywidth = $(window).width();
            if(Bodywidth >= 601)
            {
                if(settings.withtooltip===false)
                {
                    $(".MetroToolTip").hide();
                }
                else
                {
                    $(".MetroToolTip").show();    
                }
                
            }
            else
            {
                $(".MetroToolTip").hide();
                return 0;
            }

            var Bodywidth = $(window).width();
            if(Bodywidth >= 601 && settings.withtooltip == true)
            {
                $(".MetroToolTip").removeClass("animated fadeOut fast");
            }


            if(SubMenuOpen == false)
            {

                $(".MetroToolTip").show().addClass("animated fadeIn fast");
                SubMenuOpen = true;    
            }

            $(".ToolImagen").removeClass("fadeIn").delay(200).queue(function(){
                // clearQueue();
                $(this).addClass("fadeIn");
            });

            var Picture = $(this).attr("picture");
            var optionname = $(this).attr("optionname");
            var SubMenuOptions = $(this).attr("submenuitems");

            $("#ActiveIcon").attr("src",Picture);
            $("#toolTitle").text(optionname);
            $("#toolText").text(SubMenuOptions);
        });

        // Click event on Menu Option
        $(".MenuOption").bind("click",function(){
            var ID = $(this).attr("id");
            var Picture = $(this).attr("picture");
            var menuoptionI = $(this).attr("menuoptionI");
            var SubMenuOptionsNumber = $(this).attr("SubMenuOptionsNumber");
            var TextName = $(this).attr("optionname");

            if(SubMenuOptionsNumber == 0)
            {
                if (typeof callback == "function") 
                {   
                    if(callback)callback(TextName);
                }

                if(settings.closeonclick=== true)
                {
                    MetroMenuIsOpen = 0;
                    $(".MetroToolTip").removeClass("fast").addClass("fadeOut");
                    $(".MetroMenuBox").addClass("fadeOut fast").delay(300).queue(function(){
                        $(this).remove();
                        $(".MetroToolTip").remove();
                    });
                }
            }
            else
            {
                // Has options... showing submenu
                $("#MenuOptionBar").removeClass("fadeIn").addClass("fadeOut").delay(200).queue(function(){
                    $(this).hide();

                    var SubMenu = '<div class="BackArrow SubMenuIcon animated '+ settings.animation +'" backto="raiz">';
                        SubMenu += '<img src="'+ settings.backicon +'" class="SubtitleMenuIcon">';
                        // SubMenu += '<span class="MenuOptionText">Back</span>';
                        SubMenu += '</div>';

                        // alert(settings.items[menuoptionI].items[0].icon);
                        for (var j = 0; j < SubMenuOptionsNumber; j++) 
                        {
                            if(settings.items[menuoptionI].items[j].link == undefined)
                            {
                                // There is sub menu items inside the submenu
                                if(settings.items[menuoptionI].items[j].items != undefined)
                                {
                                    var Childs = settings.items[menuoptionI].items[j].items.length;

                                    SubMenu += '<div parentNumber='+ menuoptionI +' parentSubNumber='+ j +' submenuchilds='+ Childs +' class="SubMenuTitle SubMenuIcon" id="Men'+ j +'" subicon="'+ settings.items[menuoptionI].items[j].icon +'" optionname="'+ settings.items[menuoptionI].items[j].name +'">';
                                    SubMenu += '<img src="'+ settings.items[menuoptionI].items[j].icon +'" class="SubtitleMenuIcon">';
                                    SubMenu += '<span class="MenuOptionText">'+ settings.items[menuoptionI].items[j].name +'</span>';
                                    SubMenu += '</div>';
                                }
                                else
                                {
                                    // There's no submenu options
                                    SubMenu += '<div submenuchilds="0" class="SubMenuTitle SubMenuIcon" id="Men'+ j +'" subicon="'+ settings.items[menuoptionI].items[j].icon +'" optionname="'+ settings.items[menuoptionI].items[j].name +'">';
                                    SubMenu += '<img src="'+ settings.items[menuoptionI].items[j].icon +'" class="SubtitleMenuIcon">';
                                    SubMenu += '<span class="MenuOptionText">'+ settings.items[menuoptionI].items[j].name +'</span>';
                                    SubMenu += '</div>';
                                }

                            }
                            else
                            {  
                                SubMenu += '<a href ="'+ settings.items[menuoptionI].items[j].link +'" style="border-style: none">';
                                SubMenu += '<div class="SubMenuTitle SubMenuIcon" id="Men'+ j +'" subicon="'+ settings.items[menuoptionI].items[j].icon +'" optionname="'+ settings.items[menuoptionI].items[j].name +'">';
                                SubMenu += '<img src="'+ settings.items[menuoptionI].items[j].icon +'" class="SubtitleMenuIcon" border="none">';
                                SubMenu += '<span class="MenuOptionText">'+ settings.items[menuoptionI].items[j].name +'</span>';
                                SubMenu += '</div>';
                                SubMenu += '</a>';
                            }
                            
                        };

                    $(".SubMenuOptionBar").append(SubMenu);

                    if(settings.position == "top" || settings.position == "bottom")
                    {
                        $(".SubMenuTitle").css("width", "90px");
                        $(".SubMenuTitle").css("float", "left");
                        $(".BackArrow").css("float", "left");
                        $(".BackArrow").css("width", "90px");
                        $(".SubMenuTitle").css("padding-top", "10px");
                        $(".SubMenuTitle").css("padding-bottom", "5px");
                        $(".SubtitleMenuIcon").css("height","50px");

                        SubMenuPointer = -1;
                        SubMenuOptionAnimatinIn(SubMenuOptionsNumber);
                    }
                    else
                    {
                        SubMenuPointer = -1;
                        SubMenuOptionAnimatinIn(SubMenuOptionsNumber);

                        CurrentSubMenuOptions = SubMenuOptionsNumber;
                        MenuResizeSubmenu(SubMenuOptionsNumber);
                    }

                  

                    $(".SubMenuTitle").bind("mouseover",function(){
                        var SubIcon = $(this).attr("subicon");
                        $("#ActiveIconSub1").show().removeClass("animated fadeOut fast").addClass("animated fadeInLeft");
                        $("#ActiveIconSub1").attr("src",SubIcon);

                        var Bodywidth = $(window).width();
                        if(Bodywidth >= 601 && settings.withtooltip == true)
                        {
                            $(".MetroToolTip").removeClass("animated fadeOut fast");
                            $(".MetroToolTip").show().addClass("animated fadeIn fast");
                        }

                    });

                    $('.SubMenuTitle').hover(function()
                    {
                        var ThisID = $(this).attr('id');
                        $("#"+ThisID).css("background-color", settings.color2);
                    },
                    function()
                    {
                        var ThisID = $(this).attr('id');
                        $("#"+ThisID).css("background-color", "transparent");
                    });

                    // SubObtion Clicked
                    $(".SubMenuTitle").bind("click", function(){
                        
                        var TextName = $(this).attr("optionname");
                        var Menu = settings.items[menuoptionI].name;
                        var HasSubItems = $(this).attr("submenuchilds");
                        var parentNumber = $(this).attr("parentNumber");
                        var parentSubNumber = $(this).attr("parentSubNumber");

                        // If the sub menu has submenu childs
                        if(HasSubItems >0){

                            var SubMenu ="";
                             $(".SubMenuTitle").remove();
                             $("#SubMenuOptionBar").hide();

                             for(i=0;i<HasSubItems;i++)
                             {
                                // There is sub menu items inside the submenu       

                                // Check if the sub sub menu item, has a link value
                                if( settings.items[parentNumber].items[parentSubNumber].items[i].link == undefined)
                                {
                                    var ReturnText = settings.items[parentNumber].name + "." + settings.items[parentNumber].items[parentSubNumber].name + "." + settings.items[parentNumber].items[parentSubNumber].items[i].name;

                                    SubMenu += '<div class="SubMenuTitle SubMenuIcon animated '+ settings.animation +' SubSub" returntext="'+ ReturnText +'">';
                                    SubMenu += '<img src="'+ settings.items[parentNumber].items[parentSubNumber].items[i].icon +'" class="SubtitleMenuIcon">';      
                                    SubMenu += '<span class="MenuOptionText">'+ settings.items[parentNumber].items[parentSubNumber].items[i].name +'</span>';       
                                    SubMenu += '</div>';  
                                }
                                else
                                {
                                    // has a link value
                                    SubMenu += '<a href ="'+ settings.items[parentNumber].items[parentSubNumber].items[i].link +'" style="border-style: none">';
                                    SubMenu += '<div class="SubMenuTitle SubMenuIcon animated '+ settings.animation +'">';
                                    SubMenu += '<img src="'+ settings.items[parentNumber].items[parentSubNumber].items[i].icon +'" class="SubtitleMenuIcon" border="none">';
                                    SubMenu += '<span class="MenuOptionText">'+ settings.items[parentNumber].items[parentSubNumber].items[i].name +'</span>';
                                    SubMenu += '</div>';
                                    SubMenu += '</a>';
                                }
                                
                             }  

                             $("#SubMenuOptionBar").show().append(SubMenu);

                                if(settings.position == "top" || settings.position == "bottom")
                                {
                                    $(".SubMenuTitle").css("width", "90px");
                                    $(".SubMenuTitle").css("float", "left");
                                    $(".BackArrow").css("float", "left");
                                    $(".BackArrow").css("width", "90px");
                                    $(".SubMenuTitle").css("padding-top", "10px");
                                    $(".SubMenuTitle").css("padding-bottom", "5px");
                                    $(".SubtitleMenuIcon").css("height","50px");
                                }

                                // Mouse Hover color
                                $('.SubMenuTitle').hover(function()
                                {
                                    // var ThisID = $(this).attr('id');
                                    $(this).css("background-color", settings.color2);
                                    
                                    var Bodywidth = $(window).width();
                                    if(Bodywidth >= 601 && settings.withtooltip == true)
                                    {
                                        $(".MetroToolTip").removeClass("animated fadeOut fast");
                                        $(".MetroToolTip").show().addClass("animated fadeIn fast");
                                    }

                                },
                                function()
                                {
                                    // var ThisID = $(this).attr('id');
                                    $(this).css("background-color", "transparent");
                                });

                                

                                // Adding the click functionallity to the sub submenuopcions
                                $(".SubSub").on("click",function(){

                                    var ReturnText = $(this).attr("returntext");

                                    if (typeof callback == "function") 
                                    {   
                                        if(callback)callback(ReturnText);
                                    }

                                    if(settings.closeonclick=== true)
                                    {
                                        MetroMenuIsOpen = 0;
                                        $(".MetroToolTip").removeClass("fast").addClass("fadeOut");
                                        $(".MetroMenuBox").addClass("fadeOut fast").delay(300).queue(function(){
                                            $(this).remove();
                                            $(".MetroToolTip").remove();
                                        });
                                    }
                                });
                                // End of Sub Sub

                        }
                        else{
                            // Do not have submenu items
                            if (typeof callback == "function") 
                            {   
                                if(callback)callback(Menu+"."+TextName);
                            }

                            if(settings.closeonclick=== true)
                            {
                                MetroMenuIsOpen = 0;
                                $(".MetroToolTip").removeClass("fast").addClass("fadeOut");
                                $(".MetroMenuBox").addClass("fadeOut fast").delay(300).queue(function(){
                                    $(this).remove();
                                    $(".MetroToolTip").remove();
                                });
                            }
                        }
                            

                    });
                    

                    // Hide the submenu
                    $(".BackArrow").bind("click", function(){
                        var ReturnTo = $(this).attr("backto");
                        $(".SubMenuTitle").removeClass(settings.animation).addClass("fadeOut");
                        $("#ActiveIconSub1").show().removeClass("animated " + settings.animation).addClass("animated fadeOut fast");

                        $(this).removeClass(settings.animation).addClass("fadeOut").delay(300).queue(function(){
                            $(this).remove();
                            $(".SubMenuTitle").remove();
                            $("#MenuOptionBar").clearQueue();
                            $("#ActiveIconSub1").clearQueue();
                            $("#MenuOptionBar").removeClass("fadeOut").show();
                        });
                    });
                });
            }   
        });   
       
        // Special Functions
        // On windows change size...
        $(window).bind("resize",function() 
        {


            if(settings.position == "top" || settings.position == "bottom")
            {
                // MenuResizeTopBottom();
                // MenuResizeSubmenu(CurrentSubMenuOptions);
                //Small iPad fix
                var isiPad = navigator.userAgent.match(/iPad/i) != null;
                if(isiPad===false)
                {
                    SubMenuPosition();
                    MenuRaiz();
                }
                
            }
            else
            {
                MenuResize();
                MenuResizeSubmenu(CurrentSubMenuOptions);    
            }
            
        });  //End resizing function

        // Close on body click
        // if(settings.bodyclickclose===true)
        // {
        //     $("body").bind("click",function()
        //     {
        //         if(MenuLoad==1)
        //         {
        //             if(MouseOverMenu==0)
        //             {
        //                 MetroMenuIsOpen = 0;
        //                 $(".MetroToolTip").removeClass("fast").addClass("fadeOut");
        //                 $(".MetroMenuBox").addClass("fadeOut fast").delay(200).queue(function()
        //                 {
        //                     $(this).remove();
        //                     $(".MetroToolTip").remove();
        //                 });
        //             }    
        //         }
                
        //     });
        // }

        if(settings.escclose===true)
        {
            $(document).keyup(function(e) {
              if (e.keyCode == 27) 
              { 
                    MetroMenuIsOpen = 0;
                    $(".MetroToolTip").removeClass("fast").addClass("fadeOut");
                    $(".MetroMenuBox").addClass("fadeOut fast").delay(200).queue(function()
                    {
                        $(this).remove();
                        $(".MetroToolTip").remove();
                    });
              }   
            });
        }


        // Function to resize the menu if the position is top or bottom
        function MenuResizeTopBottom()
        {

            var BodyHeight = $(window).height();
            var Bodywidth = $(window).width();
        }

        // Function to resize the menu height
        function MenuResize()
        {

            $(".MenuIcon").css("height","50px");
            $(".MenuOption").css("font-size","18px");

            var BodyHeight = $(window).height();
            var Bodywidth = $(window).width();
            var MenuHeight = $("#MenuOptionBar").css("height");
            var SpaceNeeded = MainOptions * 100;

            BodyHeight = BodyHeight * 1;
            MenuHeight = MenuHeight.replace("px","");
           
            // Tooltip if
            if(Bodywidth >= 601)
            {
                // $(".MetroToolTip").show();
            }
            else
            {
                $(".MetroToolTip").hide();
            }
                


            if(BodyHeight < 300)
            {
                $(".MenuOptionText").hide();
                $(".MetroMenuBox").css("padding-left","10px");
                $(".MetroMenuBox").css("padding-right","10px");
                $(".MenuOption").css("padding-bottom","2px");
                
                $(".MenuOption").css("padding-top","2px");
                $(".MenuOption").css("padding-bottom","2px");

                $(".MetroMenuBox").css("width","25px");
                
            }
            else
            {
                $(".MenuOptionText").show();
                $(".MetroMenuBox").css("width","100px");
                $(".MetroMenuBox").css("padding-left","5px");
                $(".MetroMenuBox").css("padding-right","5px");
                $(".MenuOption").css("padding-top","10px");
                $(".MenuOption").css("padding-bottom","10px");
            }

            // alert(BodyHeight + "  " + SpaceNeeded)
            if(BodyHeight < SpaceNeeded)
            {  
                // We need to perform an adaptation to the MenuIcons
                // First try, reducin padding.
                $(".MenuOption").css("padding-bottom","10px");

                // Check the new height 
                var MenuHeight = $("#MenuOptionBar").css("height");
                MenuHeight = MenuHeight.replace("px","");
                MenuHeight = MenuHeight - 20; //Some space correction

                if(BodyHeight < 450)
                {
                    $(".MetroMenuBox").css("width","50px");
                }
                else
                {
                    $(".MetroMenuBox").css("width","80px");    
                }
                

                if(BodyHeight < MenuHeight)
                {
                    // Still needs more adapt
                    var Diferencia = MenuHeight - BodyHeight;
                    var IconSize = 50;
                    var BlockIconSize = IconSize * MainOptions;
                    BlockIconSize = BlockIconSize - Diferencia;
                    var NewIconSize = BlockIconSize / MainOptions;
                    var WidthSize = NewIconSize + 20;
                    NewIconSize = NewIconSize + "px";

                    $(".MenuIcon").css("height",NewIconSize);
                    $(".MenuOption").css("font-size","15px");

                    if(BodyHeight > 450)
                    {
                        var width = $(".MenuOption").css("width");
                        $(".MetroMenuBox").css("width","70px");
                    }
                    else
                    {
                        $(".MetroMenuBox").css("width",WidthSize+"px");
                    }
                }                
            }
        }

        // Function to resize the menu
        function MenuResizeTopBottom()
        {
            // alert("Acomodarsdasd");
        }

         // Function to resize the submenu height
        function MenuResizeSubmenu(SubMenuOptionsNumber)
        {
            SubMenuOptionsNumber = parseInt(SubMenuOptionsNumber) + 1;
            $(".SubtitleMenuIcon").css("height","50px");
            $(".SubMenuOptionBar").css("font-size","18px");

            var BodyHeight = $(window).height();
            var MenuHeight = $(".SubMenuOptionBar").css("height");
            var SpaceNeeded = SubMenuOptionsNumber * 100;

            MenuHeight = MenuHeight.replace("px","");

            if(BodyHeight < 300)
            {

                $(".MenuOptionText").hide();
                $(".MetroMenuBox").css("padding-left","10px");
                $(".MetroMenuBox").css("padding-right","10px");
                $(".SubMenuTitle").css("padding-bottom","2px");
                
                $(".SubMenuTitle").css("padding-top","2px");
                $(".SubMenuTitle").css("padding-bottom","2px");

                $(".MetroMenuBox").css("width","25px");
                
            }
            else
            {
                $(".MenuOptionText").show();
                $(".MetroMenuBox").css("width","100px");
                $(".MetroMenuBox").css("padding-left","5px");
                $(".MetroMenuBox").css("padding-right","5px");
                $(".SubMenuTitle").css("padding-top","10px");
                $(".SubMenuTitle").css("padding-bottom","10px");
            }

            if(BodyHeight < SpaceNeeded)
            {  
                // We need to perform an adaptation to the SubMenuIcons
                // First try, reducin padding.
                $(".SubMenuOptionBar").css("padding-bottom","10px");

                // Check the new height 
                var MenuHeight = $("#SubMenuOptionBar").css("height");
                MenuHeight = MenuHeight.replace("px","");
                MenuHeight = MenuHeight - 20; //Some space correction
                
                if(BodyHeight < MenuHeight)
                {

                    // Still needs more adapt
                    var Diferencia = MenuHeight - BodyHeight;
                    var IconSize = 50;
                    var BlockIconSize = IconSize * SubMenuOptionsNumber;
                    BlockIconSize = BlockIconSize - Diferencia;
                    var NewIconSize = (BlockIconSize / SubMenuOptionsNumber);
                    NewIconSize = NewIconSize + "px";

                    $(".SubtitleMenuIcon").css("height",NewIconSize);
                    $(".SubMenuOptionBar").css("font-size","15px");

                }                
            }
        }

        // In Animation for the Menu Items
        function MenuRaiz()
        {
            if(MenuAnimarPaso1 == 0)
            {
                return 0
            }

            if(MiddlePointDone === false)
            {
                MiddlePointDone = true;
                MiddlePoint = MenuID / 2;
                MiddlePoint = Math.floor(MiddlePoint);
                if (MenuID%2==0)
                {
                    // Impar
                    MenuAnimarPaso1 = MiddlePoint;
                    MenuAnimarPaso2 = MiddlePoint;

                    // alert(MenuAnimarPaso1);

                    $("#MenuOption"+MenuAnimarPaso1).addClass("animated " + settings.animation).css("opacity",1).delay(120).queue(function(next){
                        MenuAnimarPaso1 +=1;
                        $(this).show();
                        MenuRaiz();
                    });

                    $("#MenuOption"+MenuAnimarPaso2).addClass("animated " + settings.animation).css("opacity",1);
                        MenuAnimarPaso2 -=1;
                }
                else
                {
                    // Es Par
                    MenuAnimarPaso1 = MiddlePoint;
                    MenuAnimarPaso2 = MiddlePoint+1;

                    $("#MenuOption"+MenuAnimarPaso1).addClass("animated " + settings.animation).css("opacity",1).delay(150).queue(function(next){
                        MenuAnimarPaso1 +=1;
                        MenuRaiz();
                    });

                    $("#MenuOption"+MenuAnimarPaso2).addClass("animated " + settings.animation).css("opacity",1);
                        MenuAnimarPaso2 -=1;
                }
            }

            $("#MenuOption"+MenuAnimarPaso1).addClass("animated " + settings.animation).css("opacity",1).delay(150).queue(function(next){
                MenuAnimarPaso1 +=1;
                MenuRaiz();
            });

            $("#MenuOption"+MenuAnimarPaso2).addClass("animated " + settings.animation).css("opacity",1);
                MenuAnimarPaso2 -=1;
        } // End if Animation In

        function SubMenuOptionAnimatinIn(SubMenuNumber)
        {

            if(SubMenuPointer < SubMenuNumber)
            {

                if(SubMenuPointer == -1)
                {
                    $("#Men0").delay(100).queue(function(){
                        SubMenuPointer = 0;
                        SubMenuOptionAnimatinIn(SubMenuNumber);
                    });
                }
                else
                {
                    
                    $("#Men"+SubMenuPointer).show();
                    $("#Men"+SubMenuPointer).clearQueue();
                    $("#Men"+SubMenuPointer).addClass("animated " + settings.animation).delay(100).queue(function()
                    {
                            SubMenuPointer += 1;
                            SubMenuOptionAnimatinIn(SubMenuNumber);
                    });
                }
            }
        }

        // Fix the animation speed
        function AnimationFix()
        {
            switch (settings.animation)
            {
                case "fadeIn":
                    settings.animation += " fast";
                    break;
                case "fadeInRight":
                    settings.animation += " fast";
                    break;
                case "fadeInLeft":
                    settings.animation += " fast";
                    break;
                case "fadeInUp":
                    settings.animation += " fast";
                    break;
                case "fadeInDown":
                    settings.animation += " fast";
                    break;
                    
            }
        }

        // Control Position fix
        function MenuPositionFix()
        {
            if(settings.divholderid !=undefined)
            {
                $(".MetroMenuBox").css("position","relative");
            }
            else
            {
                switch (settings.position)
                {
                    case "left":
                        $(".MetroMenuBox").css("left","0px");
                        $(".MetroMenuBox").css("height","100%");
                        $(".MetroMenuBox").css("width","75px");
                        $(".MetroMenuBox").css("top","0px");

                        
                        $(".MetroToolTip").css("bottom","10px");
                        $(".MetroToolTip").css("right","10px");
                        break;

                    case "right":
                        $(".MetroMenuBox").css("right","0px");
                        $(".MetroMenuBox").css("height","100%");
                        $(".MetroMenuBox").css("width","75px");
                        $(".MetroMenuBox").css("top","0px");
                        
                        $(".MetroToolTip").css("bottom","10px");
                        $(".MetroToolTip").css("left","10px");
                        break;

                    case "top":
                        $(".MetroMenuBox").css("top","0px");
                        $(".MetroMenuBox").css("left","0px");
                        $(".MetroMenuBox").css("width","100%");
                        
                        $(".MetroToolTip").css("bottom","10px");
                        $(".MetroToolTip").css("right","20px");
                        break;

                    case "bottom":
                        $(".MetroMenuBox").css("bottom","0px");
                        $(".MetroMenuBox").css("left","0px");
                        $(".MetroMenuBox").css("width","100%");
                        
                        $(".MetroToolTip").css("top","10px");
                        $(".MetroToolTip").css("right","20px");

                        //Small iPad fix
                        var isiPad = navigator.userAgent.match(/iPad/i) != null;
                        if(isiPad===true)
                        {
                            $(".MetroMenuBox").css("padding-bottom","15px");
                        }
                        break;

                    default:
                        $(".MetroMenuBox").css("left","0px");
                        $(".MetroMenuBox").css("height","100%");
                        $(".MetroMenuBox").css("width","10px");
                        $(".MetroToolTip").css("right","10px");
                        break;
                }
            }
            

        }

        function SubMenuPosition()
        {
            switch (settings.position)
            {
                case "left":
                    
                    break;

                case "right":
                
                    break;

                case "top":

                    $(".MenuOption").css("width","100px");
                    $(".MenuOption").css("float","left");
                    $(".MenuOption").css("padding-top","10px");
                    $(".MenuOption").css("padding-bottom","5px");
                    break;

                case "bottom":
                    $(".MenuOption").css("width","100px");
                    $(".MenuOption").css("float","left");
                    $(".MenuOption").css("padding-top","10px");
                    $(".MenuOption").css("padding-bottom","5px");
                    break;

                default:
                    
                    break;
            }


        }
        
    }

})(jQuery);


