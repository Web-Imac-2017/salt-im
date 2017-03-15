import React, {Component} from 'react'
import Header from '../../components/Header'
import Footer from '../../components/Footer'
import './CoreLayout.scss'
import '../../styles/core.scss'

// u/session


export default class CoreLayout extends Component {
    constructor(props) {
      super(props);

      this.state = {
        dataUser:null,
      };
    }

    loadUser(){
        fetch("http://localhost/salt-im/api/u/islogged/2")
            .then((data) => {return data.text()})
            .then((data) => {
                this.setState({dataUser:data,})
            })
    }

    componentWillMount() {
        setTimeout(() => {
            this.loadUser();
        },5000)
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
