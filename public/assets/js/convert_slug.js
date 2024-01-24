function convertSlug (string) {
    let slug = string
    //Đổi chữ hoa thành chữ thường
    slug = slug.toLowerCase()

    //Đổi ký tự có dấu thành không dấu
    slug = slug.replace(/à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ/g,"a");
    slug = slug.replace(/è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ/g,"e");
    slug = slug.replace(/ì|í|ị|ỉ|ĩ/g,"i");
    slug = slug.replace(/ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ/g,"o");
    slug = slug.replace(/ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ/g,"u");
    slug = slug.replace(/ỳ|ý|ỵ|ỷ|ỹ/g,"y");
    slug = slug.replace(/đ/g,"d");
    slug = slug.replace(/À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ/g, "A");
    slug = slug.replace(/È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ/g, "E");
    slug = slug.replace(/Ì|Í|Ị|Ỉ|Ĩ/g, "I");
    slug = slug.replace(/Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ/g, "O");
    slug = slug.replace(/Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ/g, "U");
    slug = slug.replace(/Ỳ|Ý|Ỵ|Ỷ|Ỹ/g, "Y");
    slug = slug.replace(/Đ/g, "D");
    // Một vài bộ encode coi các dấu mũ, dấu chữ như một kí tự riêng biệt nên thêm hai dòng này
    slug = slug.replace(/\u0300|\u0301|\u0303|\u0309|\u0323/g, ""); // ̀ ́ ̃ ̉ ̣  huyền, sắc, ngã, hỏi, nặng
    slug = slug.replace(/\u02C6|\u0306|\u031B/g, ""); // ˆ ̆ ̛  Â, Ê, Ă, Ơ, Ư
    //Xóa các ký tự đặt biệt
    slug = slug.replace(
        /\`|\~|\-|\!|\@|\#|\||\$|\%|\^|\&|\*|\(|\)|\+|\=|\,|\.|\/|\?|\>|\<|\'|\"|\:|\;|_/gi,
        '')
    //Đổi khoảng trắng thành ký tự gạch ngang
    slug = slug.replace(/ /gi, '-')
    //Đổi nhiều ký tự gạch ngang liên tiếp thành 1 ký tự gạch ngang
    //Phòng trường hợp người nhập vào quá nhiều ký tự trắng
    slug = slug.replace(/\-\-\-\-\-/gi, '-')
    slug = slug.replace(/\-\-\-\-/gi, '-')
    slug = slug.replace(/\-\-\-/gi, '-')
    slug = slug.replace(/\-\-/gi, '-')
    //Xóa các ký tự gạch ngang ở đầu và cuối
    slug = '@' + slug + '@'
    slug = slug.replace(/\@\-|\-\@|\@/gi, '')
    //In slug ra textbox có id “slug”
    return slug
}
