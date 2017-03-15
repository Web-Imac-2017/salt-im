import React, {Component} from 'react'
import Header from '../../components/Header'
import Footer from '../../components/Footer'
import './CoreLayout.scss'
import '../../styles/core.scss'

// u/session


export default class CoreLayout extends Component {
    componentDidMount() {
        console.log("did mount")
        fetch("http://localhost/salt-im/api/p/u/session")
            .then((data) => data.text())
            .then((data) => {console.log(data)})
    }

    render() {
        console.log("render layout")
        return (
            <div className='container text-center'>
              <Header />
              <div className='core-layout__viewport'>
                {this.props.children}
              </div>
              <Footer />
            </div>
        )
    }
}

CoreLayout.propTypes = {
  children : React.PropTypes.element.isRequired
}
