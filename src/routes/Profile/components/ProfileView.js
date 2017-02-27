import React from 'react'
import './ProfileView.scss'
import ListPost from '../../../components/ListPost/ListPost.js'

const dataListPost = [
    {
        "id":0,
        "type":"link",
        "url":"http://internetactu.blog.lemonde.fr/2017/02/19/apres-lintelligence-artificielle-lintelligence-etendue/",
        "title":"Super title putaclic",
        "description":"Sa darrone ils boivent du sprite sa mère",
        "salt":19,
        "pepper":20,
        "tags":["boisson","mere","buzz"],
        "date":"12 jan. 2017",
        "author":"Thomas Lerouô"
    },
    {
        "id":1,
        "type":"image",
        "url":"http://vignette3.wikia.nocookie.net/logopedia/images/f/f5/Sprite_logo2.jpg/revision/latest?cb=20140618132523",
        "title":"Super title putaclic sa mère",
        "description":"Sa darrone ils boivent du sprite sa mère",
        "salt":18,
        "pepper":20,
        "tags":["boisson","mere"],
        "date":"12 jan. 2017",
        "author":"Thomas Lerouô"
    },
    {
        "id":2,
        "type":"image",
        "url":"http://vignette3.wikia.nocookie.net/logopedia/images/f/f5/Sprite_logo2.jpg/revision/latest?cb=20140618132523",
        "title":"Bonsoir je crois que je suis ré-bou",
        "description":"le lorem ipsum est un langage qu'on utilise quand on boit beaucoup de Karsquell",
        "salt":67,
        "pepper":18,
        "tags":["Karsquell","Bourré"],
        "date":"14 fév. 2017",
        "author":"Inspecteur"
    }
]

const userData = {
    "pseudo":"Jean-mi",
    "picUrl":"http://img.voi.pmdstatic.net/fit/http.3A.2F.2Fwww.2Evoici.2Efr.2Fvar.2Fvoi.2Fstorage.2Fimages.2Fmedia.2Fmultiupload-du-06-janvier-2017.2Fmimie-mathy.2F10213397-1-fre-FR.2Fmimie-mathy.2Ejpg/1237x693/quality/80/mimie-mathy.jpg",
   	"rank":"Salégaud",
   	"email":"jeanmi@mail.fr"
}

const backgroundUrlStyle = {
    backgroundImage: "url("+userData.picUrl+")"
}

export const ProfileView = () => (
  <div className="profile center">
    <div className="profile__header">

    	<div className="profile__header__pic" style={backgroundUrlStyle}></div>
    	<div className="profile__header__infos">
    		<h1 className="profile__header__infos__pseudo">{userData.pseudo}</h1>
	    	<h2 className="profile__header__infos__email">{userData.email}</h2>
	    	<h2 className="profile__header__infos__rank">{userData.rank}</h2>
    	</div>
    	<button className="profile__header__updateBtn">modifier mon profil</button>

    </div>

    <div className="profile__nav">
    <ul className="profile__nav__list">
    	<li className="profile__nav__list__item profile__nav__list--active">Posts (3)</li>
    	<li className="profile__nav__list__item">Commentaires (530)</li>
    	<li className="profile__nav__list__item">Favoris (11)</li>
    </ul>
    </div>

    <ListPost title="Posts tendances" data={dataListPost} />

  </div>
)

export default ProfileView
