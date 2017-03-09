// import React from 'react'
// import { IndexLink, Link } from 'react-router'
// import './BigSearch.scss'

// export const BigSearch = () => (
//   <div className="bigsearch">
//     bigsearch
//   </div>
// )

// export default BigSearch


import React, { Component } from 'react';
import { Link } from 'react-router';
import './BigSearch.scss'

class BigSearch extends Component {
  constructor(props) {
    super(props);

    this.state = {
        isOpen:false,
    };
  }

  componentWillReceiveProps(nextProps) {
      this.setState({
        isOpen:nextProps.isOpen
      })
  }

  render() {
    let classes = "bigsearch";
    if(this.state.isOpen)
        classes += " bigsearch--open"
    return (
      <div className={classes}>
        <form>
            <input type="text" placeholder="Search"/>
        </form>
      </div>
    );
  }
}

export default BigSearch;
