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
        let endURL = this.youtube_parser(url);
        if(!endURL){
            endURL = this.daily_parser(url);
            if(!endURL)
                return {"type":"link","id":null}
            else
                return
                    return {"dl":"yt","id":endURL};
        }
        else
            return {"type":"yt","id":endURL};
    },

    checkImg(val) {
        let regExp = /\.(gif|jpg|jpeg|png)$/i;
        let match = val.match(regExp);
        return (match)? match[1] : false;

    },

    getTypeData(val) {
        let type = this.video_parser(val).type;
        if(type == "link") {
            type = this.checkImg(val);
        }

        return type;
    },

    getFetchUrl() {
        return "http://localhost/salt-im/api"
        //return "http://saltfactory.tk/api"
    }
}

module.exports = utils;
