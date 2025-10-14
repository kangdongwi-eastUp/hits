window.onload = function(){
    $('body').addClass('loaded')
}

//====================
$(function(){
    let page = $('#input_page').val();
    if($('header').length > 0){
        $('header').load('/includes/admin.header.html', function(){
            if(page != ''){
                $(`.gnb a[data-value="${page}"]`).addClass('active')
            }
        })
    }
})