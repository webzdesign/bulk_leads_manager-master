
$(document).ready(function(){

    $('.menuicn').click(function () {
        $('aside').toggleClass('sidebarClose');
        $('.d-none-add').addClass('displayNone');
        $('.sidebarOverlay').removeClass('d-none');
    });

    $('.sidebarOverlay').click(function(){
        $('.sidebarOverlay').addClass('d-none');
        $('aside').removeClass('sidebarClose');
    })

    // custom select

    $('select').each(function () {
        var $this = $(this), numberOfOptions = $(this).children('option').length;

        $this.addClass('select-hidden');
        $this.wrap('<div class="select"></div>');
        $this.after('<div class="select-styled"></div>');
        $('.select').append('<svg width="16" height="16" viewBox="0 0 16 16" fill="none" xmlns="http://www.w3.org/2000/svg"><path d="M2.66675 6L8.00008 11.3333L13.3334 6" stroke="#7B809A" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"/></svg>');

        var $styledSelect = $this.next('div.select-styled');
        $styledSelect.text($this.children('option').eq(0).text());

        var $list = $('<ul />', {
            'class': 'select-options'
        }).insertAfter($styledSelect);

        for (var i = 0; i < numberOfOptions; i++) {
            $('<li />', {
                text: $this.children('option').eq(i).text(),
                rel: $this.children('option').eq(i).val()
            }).appendTo($list);
            //if ($this.children('option').eq(i).is(':selected')){
            //  $('li[rel="' + $this.children('option').eq(i).val() + '"]').addClass('is-selected')
            //}
        }

        var $listItems = $list.children('li');

        $styledSelect.click(function (e) {
            e.stopPropagation();
            $('div.select-styled.active').not(this).each(function () {
                $(this).removeClass('active').next('ul.select-options').hide();
            });
            $(this).toggleClass('active').next('ul.select-options').toggle();
        });

        $listItems.click(function (e) {
            $(this).parent().parent().find('.select-styled').addClass('selected');
            e.stopPropagation();
            $styledSelect.text($(this).text()).removeClass('active');
            $this.val($(this).attr('rel'));
            $list.hide();
            //console.log($this.val());
        });

        $(document).click(function () {
            $styledSelect.removeClass('active');
            $list.hide();
        });

    });

    // file upload
    $("form").on("change", ".file-upload-field", function(){
        $(this).parent(".fileUpload").find('.file-upload-wrapper').attr("data-text",
        $(this).val().replace(/.*(\/|\\)/, '') );
    });


    // step wizard
    var index = $(".step.active").index(".step"), stepsCount = $(".step").length, nextBtn = $("#next"), nextBtnClass = $(".next"), prevBtnClass = $(".prev"), prevBtn = $("#prev");

    prevBtn.click(function () {
        if (index > 0) {
            index--;
            $(".step").removeClass("active").eq(index).addClass("active");
            $(".stepProgress").removeClass("active").eq(index).addClass("active");
            $(".stepProgress").eq(index).removeClass("done");
        }
    });

    nextBtn.click(function () {
        if (index < stepsCount - 0) {
            for(i = 0; i <= index; i++){
                $(".stepProgress").eq(i).addClass("done");
            }
            index++;
            $(".step").removeClass("active").eq(index).addClass("active");
            $(".stepProgress").eq(index).addClass("active");
        };

        if (index == 2) {
            $(".stepProgress").parent().parent().parent().find(".addStep3").removeClass("d-none");
        }else{
            $(".stepProgress").parent().parent().parent().find(".addStep3").addClass("d-none");
        }

        if (index == 3) {
            $(".stepProgress").parent().parent().parent().find(".cards .cardsFooter").removeClass("d-flex").addClass('d-none');
        }
    });

    nextBtnClass.each(function (idx, ele) {
        $(ele).click(function(e){
            e.preventDefault();
            var nextIndex = $(this).index(".next")+1;
            $(".stepProgress").eq(idx).addClass("done");
            $(".step").removeClass("active").eq(nextIndex).addClass("active");
            $(".stepProgress").eq(nextIndex).addClass("active");
        });
    });

    prevBtnClass.each(function (idx, ele) {
        $(ele).click(function(e){
            e.preventDefault();
            var nextIndex = $(this).index(".prev");
            $(".stepProgress").eq(idx).removeClass("done");
            $(".step").removeClass("active").eq(nextIndex).addClass("active");
        });
    });


    // custom dropdown

        function t(t) {
            $(t).bind("click", function (t) {
                t.preventDefault();
                $(this).parent().fadeOut()
            })
        }
        $(".dropdown-toggle").on('click', function () {
            var t = $(this).parents(".button-dropdown").children(".dropdown-menu").is(":hidden");
            $(".button-dropdown .dropdown-menu").hide();
            $(".button-dropdown .dropdown-toggle").removeClass("active");
            if (t) {
                $(this).parents(".button-dropdown").children(".dropdown-menu").toggle().parents(".button-dropdown").children(".dropdown-toggle").addClass("active")
            }
        });
        $(document).bind("click",  function (t) {
            var n = $(t.target);
            if (!n.parents().hasClass("button-dropdown")) $(".button-dropdown .dropdown-menu").hide();
        });
        $(document).bind("click", function (t) {
            var n = $(t.target);
            if (!n.parents().hasClass("button-dropdown")) $(".button-dropdown .dropdown-toggle").removeClass("active");
        })
    });
