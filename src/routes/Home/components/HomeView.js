Data) => {this.setState({dataListTags : Data})})

        fetch("http://www.json-generator.com/api/jsoccn/get/bSmxnPKrma?indent=2")
            .then((response) => response.json())
            .then((data) =>{this.setState({dataListPost : data})})
    }

    render() {
        return(
            <div className="home center">
                <SearchBar/>
                <p className="tagview__titleTrends">Tags tendances</p>
                <ListTagColumn data={this.state.dataListTags}/>
                <div className="tagview__section">
                    <div className="home__titles">
                        <p className="tagview__titleTrends">Les salés du jour</p>
                        <Filter/>
                    </div>
                    <ListPost data={this.state.dataListPost} dataUser={this.props.dataUser}/>
                </div>
            </div>
        )
    }
}
