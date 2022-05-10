
function typeSlug(that) {

    let name = jQuery(that).val();

    name = name.toLowerCase();

    name = name.replace(/\s/g, '-');

    jQuery('input[name=slug]').val(name);

}