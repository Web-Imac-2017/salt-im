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

        fetch(utils.getFetchUrl()+"/u/session/1")
            .then((data) => {return data.text()})
            .then((data) => {
              console.log("wow" + data);
                this.getUser();
            })
    }

    getUser(){
      fetch(utils.getFetchUrl()+"/u/get/1")
          .then((data) => {return data.json()})
          .then((data) => {
              this.setState({dataUser:data})
          })
    }

    componentWillMount() {
        setTimeout(() => {
            this.loadUser();
        },1)
    }

    endSession() {
      fetch(utils.getFetchUrl()+"/u/close/1")
          .then((data) => {return data.text()})
          .then((data) => {

          })
    }

    componentWillUnmount() {
      this.endSession();
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
