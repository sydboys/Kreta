/*
 * This file is part of the Kreta package.
 *
 * (c) Beñat Espiña <benatespina@gmail.com>
 * (c) Gorka Laucirica <gorka.lauzirika@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

import React from 'react';
import {Provider} from 'react-redux';
import {Router} from 'react-router';
import invariant from 'invariant';
import {RoutingContext} from 'react-router';

import {sitemap} from './../../Routes';

class Root extends React.Component {
  _renderRouter() {
    invariant(
      this.props.routingContext || this.props.routerHistory,
      '<Root /> needs either a routingContext or routerHistory to render.',
    );

    if (this.props.routingContext) {
      return <RoutingContext {...this.props.routingContext} />;
    }

    return (
      <Router history={this.props.routerHistory}>
        {sitemap}
      </Router>
    );
  }

  render() {
    return (
      <Provider store={this.props.store}>
        {this._renderRouter()}
      </Provider>
    );
  }
}

export default Root;
