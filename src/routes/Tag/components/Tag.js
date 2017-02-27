import React from 'react'
import './Tag.scss'
import ListPost from '../../../components/ListPost/ListPost.js'
import '../../Tags/components/TagView.scss'

const dataTags = {
    "title":"Nasa",
    "description":"La National Aeronautics and Space Administration, en français l'Administration nationale de l'aéronautique et de l'espace, plus connue sous son acronyme NASA, est l'agence gouvernementale qui est responsable de la majeure partie du programme spatial civil des États-Unis. La recherche aéronautique relève également du domaine de la NASA. Depuis sa création à la fin des années 1950, la NASA joue mondialement un rôle dominant dans le domaine du vol spatial habité, de l'exploration du Système solaire et de la recherche spatiale.",
    "picUrl":"http://www.geekqc.ca/wp-content/uploads/2016/11/maxresdefault-8.jpg",
    "link":"/tags/nasa"
}

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
    }
]

export const Tag = () => (

  <div className="tagSingle">
    <h1 className="tagSingle__title"> > {dataTags.title}</h1>
    <p className="tagSingle__description">{dataTags.description}</p>

    <p className="tagview__titleTrends">Posts les plus salés</p>
    <ListPost data={dataListPost} />


  </div>
)

export default Tag