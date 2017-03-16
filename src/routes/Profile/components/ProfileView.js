import React, {Component} from 'react'
import './ProfileView.scss'
import ListPost from '../../../components/ListPost/ListPost.js'
import ListComment from '../../../components/ListComment/ListComment.js'
import ProfileUpdateView from '../../ProfileUpdate/components/ProfileUpdateView.js'

import utils from '../../../../public/utils.js'

export default class ProfileView extends Component {
    constructor(props) {
      super(props);

      this.state = {
        dataUser:{},
        dataPost:{},
        dataFav:{},
        dataComment:{},
        dataBadge:{},
        badgeUser:{},
        itemActive:"posts",
        isActive:false
      };
    }

    componentDidMount() {
        // Call for user data.
        fetch(utils.getFetchUrl()+'/u/' + this.props.params.userId)
            .then( (response) => response.json())
            .then( (data) => {this.setState({dataUser:data})});

        // Call for posts data by default.
        fetch(utils.getFetchUrl()+'/p/u/' + this.props.params.userId)
            .then( (response) => response.json())
            .then( (data) => {
                this.setState({dataPost:data})
                this.loadComments();
                this.loadFavs();
                this.loadBadges();
            });

                           


    }

    loadFavs() {
        fetch('http://www.json-generator.com/api/json/get/bMNOSXbUte?indent=2')
            .then( (response) => response.json())
            .then( (data) => {this.setState({dataFav:data})});
    }

    loadBadges() {
        fetch('http://www.json-generator.com/api/json/get/bXHxxUeQAy?indent=2')
            .then( (response) => response.json())
            .then( (data) => {
                this.setState({dataBadge:data})
                 this.getBadge();
            });
    }

    loadComments() {
        fetch(utils.getFetchUrl()+'/comment/u/' + this.props.params.userId)
            .then( (response) => response.json())
            .then( (data) => {this.setState({dataComment:data})});
    }

    handleCommentClick(e) {
        this.clicked(this,e)
        this.setState({
            itemActive:"comments"
        })
    }

    handleFavsClick(e) {
        this.clicked(this,e)
        this.setState({
            itemActive:"favs"
        })
    }

    handlePostsClick(e) {
        this.clicked(this, e);
        this.setState({
            itemActive:"posts"
        })
    }

    toggleModal() {
        if(this.state.isActive)
            this.setState({isActive:false})
        else
            this.setState({isActive:true})
    }


    getBadge(){ 
        if(!this.state.dataBadge)
            return;

        for(let i = 0; i < this.state.dataBadge.length; i++){
            let rank = parseInt(this.state.dataUser.rank);
            let cond = this.state.dataBadge[i].cond;
                if(rank  >= cond ){
                    this.state.badgeUser = this.state.dataBadge[i];
                }
         }
       
        return;
    }

    getAllSiblings(elem) {
        var sibs = [];
        elem = elem.parentNode.firstChild;
        do {
            if (elem.nodeType === 3) continue;
            sibs.push(elem);
        } while (elem = elem.nextSibling)
        return sibs;
    }   

    clicked(ctx, e) {
        console.log("bite")
        let ok = e.target;
        let siblings = this.getAllSiblings(e.target);

        for (var i = 0; i<3; i++){
            siblings[i].classList.remove("profile__nav__list--active");
        }

        e.target.classList.add("profile__nav__list--active");

    }

    render() {
        let backgroundUrlStyle = {
            backgroundImage: "url("+this.state.dataUser.avatar+")"
        }

        let classes = "modal ";

        if(this.state.isActive)
            classes += "modal--active"

        let dataItem = (<div/>);

        switch (this.state.itemActive)
        {
            case "posts" : 
            case "comments" :
            case "favs" :
        }



        switch(this.state.itemActive) {
            case "posts" :
                dataItem = (<ListPost title="Posts tendances" data={this.state.dataPost} />);
                break;
            case "comments" :
                dataItem = (<ListComment data={this.state.dataComment}/>);
                break;
            case "favs" :
                dataItem = (<ListPost title="Posts tendances" data={this.state.dataFav} />);
                break;
            default:
                break;
        }

        return (
              <div className="profile center">

                <div className={classes}>
                    <div className="modal__filter" onClick={this.toggleModal.bind(this)}/>
                    <div className="modal__wrapper">
                        <ProfileUpdateView/>
                    </div>
                </div>

                <div className="profile__header">

                    <div className="profile__header__pic" style={backgroundUrlStyle}></div>
                    <div className="profile__header__infos">
                        <h1 className="profile__header__infos__pseudo">{this.state.dataUser.username}</h1>
                        <h2 className="profile__header__infos__email">{this.state.dataUser.mail}</h2>
                        <h2 className="profile__header__infos__rank">Elo :  {this.state.dataUser.rank}</h2>
                        <h2 className="profile__header__infos__rank">Rank : {this.state.badgeUser.name}</h2>

                    </div>
                    {this.props.dataUser ? (
                        <button className="profile__header__updateBtn" onClick={this.toggleModal.bind(this)}>modifier mon profil</button>
                    ) : (<div/>)}

                </div>

                <div className="profile__nav">
                <ul className="profile__nav__list">
                    <li className="profile__nav__list__item profile__nav__list--active" onClick={this.handlePostsClick.bind(this)}>Posts ({this.state.dataPost.length})</li>
                    <li className="profile__nav__list__item" onClick={this.handleCommentClick.bind(this)}>Commentaires ({this.state.dataComment.length})</li>
                    <li className="profile__nav__list__item" onClick={this.handleFavsClick.bind(this)}>Favoris ({this.state.dataFav.length})</li>
                </ul>
                </div>

                {dataItem}

              </div>
        )
    }
}
