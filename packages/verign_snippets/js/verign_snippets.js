/**
 * Created by dv-CRVZ25J on 26.06.2015.
 */
(function($){
    $(document).ready(function(){
        var $form = $('#verignSnippetsFormWrapper form')
        var $inputName = $form.find('input[name="name"]');


        $('#snippetList tr').each(function(){
            var $tr = $(this);
            var $snippets = $tr.find('td[data-type="snippet"]');
            var $name = $tr.find('td[data-type="name"]');
            var $editSnippet = $tr.find('.editSnippet');
            $editSnippet.on('click', function(){
                $inputName.val($name.html());
                $snippets.each(function (i, snippetTd) {
                    var $snippet = $(snippetTd);
                    var lang = $snippet.data('lang');
                    var snippet = $snippet.text();
                    var $input = $form.find('[data-lang="'+lang+'"]');
                    $input.val(snippet);
                });
            });
        });


    });
}(jQuery));