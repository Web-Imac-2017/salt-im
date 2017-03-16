import React, {Component} from 'react'
import Header from '../../components/Header'
import Footer from '../../components/Footer'
import './CoreLayout.scss'
import '../../styles/core.scss'

import utils from '../../../public/utils.js'


export default class CoreLayout extends Component {
    constructor(props) {
      super(props);

      this.state = {
        dataUser:null,
      };
    }

    loadUser(){
      console.log("usession")

        fetch(utils.getFetchUrl()+"/u/session/1",
          {
            credentials:"include"
          }
        )
            .then((data) => {return data.json()})
            .then((data) => {
              console.log("response" + data);
              console.log(data);
                //this.getUser(data);
            })
    }

    getUser(data){
      console.log(data);
      fetch(utils.getFetchUrl()+"/u/get/1")
          .then((data) => {return data.json()})
          .then((data) => {
              this.setState({dataUser:data})
          })
    }

    componentWillMount() {
      fetch(utils.getFetchUrl()+"/u/start/1",{
          })
          .then(() => {
            this.loadUser();
          })
    }

    endSession() {
      fetch(utils.getFetchUrl()+"/u/close/1")
          .then((data) => {return data.json()})
          .then((data) => {
            console.log(data);
          })
    }

    componentDidMount() {
      //this.endSession();
    }

    componentWillUnmount() {
      //this.endSession();
    }

    render() {
        return (
            <div className='container text-center'>
              <Header dataUser={this.state.dataUser}/>
              <div className='core-layout__viewport'>
                {React.cloneElement(this.props.children, {
                  dataUser:this.state.dataUser
                })}
              </div>
              <Footer />
            </div>
        )
    }
}

CoreLayout.propTypes = {
  children : React.PropTypes.element.isRequired
}
