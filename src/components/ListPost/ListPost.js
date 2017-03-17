import React, {Component} from 'react'
import './ListPost.scss'
import PostPreview from './PostPreview/PostPreview.js'

let values = [
    [
        {
            "name":0,
            "value":990,
        },
        {
            "name":1,
            "value":80,
        },
        {
            "name":2,
            "value":10,
        }
    ],
    [
        {
            "name":0,
            "value":10,
        },
        {
            "name":1,
            "value":40,
        },
        {
            "name":2,
            "value":20,
        }
    ],
    [
        {
            "name":0,
            "value":30,
        },
        {
            "name":1,
            "value":40,
        },
        {
            "name":2,
            "value":70,
        }
    ]
]

export default class ListPost extends Component {
    constructor(props) {
        super(props);

        this.state = {
            maxValue:{"name":0,"value":1},
        };
    }

    handleMax(val) {
        if(val.value>this.state.maxValue.value) {
            this.setState({maxValue:val})
        }
    }
    render() {


        if(this.props.data.map == undefined){
            if(!this.props.data.length)
                return (<div className="listpost--empty">T'es comme le "ç" de sel, t'existe pas</div>)

            let postsNode = this.props.data.map( (elmt,i) => (
                <PostPreview key={i} data={elmt} state={values[i%3]} maxValue={this.state.maxValue} handleMax={this.handleMax.bind(this)} dataUser={this.props.dataUser}/>
            ))

            return(
                <div className="listpost">
                <div className="listpost__postwrapper">
                {postsNode}
                </div>
                </div>
            )
        }

        else {
            return(
                <div className="loader">
                    <div className="loader__data">
                        <div className="imgLoader"></div>
                        <p>Déversement de sel en cours</p>
                    </div>
                </div>
            )
        }
    }
}
