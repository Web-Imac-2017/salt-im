var utils = {
    youtube_parser(url){
        let regExp = /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
        let match = url.match(regExp);
        return (match&&match[7].length==11)? match[7] : false;
    },

    daily_parser(url) {
        let regExp = /^.+dailymotion.com\/(video|hub)\/([^_]+)([^#|^?]*)(#video=([^_&]+))?/;
        let match = url.match(regExp);
        return (match&&match[7].length==11)? match[7] : false;
    },

    video_parser(url) {
        let endURL = this.youtube_parser(url) || this.daily_parser(url);
        console.log(endURL);
    }

}

module.exports = utils;
