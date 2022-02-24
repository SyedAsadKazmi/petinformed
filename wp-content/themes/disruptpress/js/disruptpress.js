jQuery(document).ready(function () {

    jQuery('.dp-social-media-share-pinterest a').click(function(){
        var og_image = jQuery('meta[property="og:image"]').attr('content');
        window.open('http://pinterest.com/pin/create/button/?url='+encodeURIComponent(location.href)+'&media=' + og_image + '&description='+document.title, '', 'width=400,height=300');return false;

    });

});