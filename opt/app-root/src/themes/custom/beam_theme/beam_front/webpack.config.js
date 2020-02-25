const path = require('path');
const MiniCssExtractPlugin = require('mini-css-extract-plugin');
const { VueLoaderPlugin } = require('vue-loader');

module.exports = (env, argv) => {
  const mode = argv.mode || 'development';
  const isDev = mode === 'development';

  return {
    mode,
    entry: './src/js/index.js',
    output: {
      filename: 'beam-front.js',
      path: path.resolve(__dirname, 'dist'),
    },
    resolve: {
      alias: {
        'vue$': 'vue/dist/vue.esm.js'
      }
    },
    module: {
      rules: [
        {
          test: /\.s[ac]ss$/i,
          use: [
            {
              loader: MiniCssExtractPlugin.loader,
              options: {
                publicPath: '../',
                hmr: isDev,
              },
            },
            'css-loader',
            'sass-loader',
          ],
        },
        {
          test: /\.(eot|woff|woff2|ttf|svg|png|jpg|gif)$/,
          use: {
            loader: 'url-loader',
            options: {
              name: '[name].[ext]',
              limit: 8192,
            }
          }
        },
        {
          test: /\.vue$/,
          loader: 'vue-loader'
        }
      ],
    },
    plugins: [
      new MiniCssExtractPlugin({
        filename: 'css/bundle.css',
        chunkFilename: '[id].css',
        ignoreOrder: false,
      }),
      new VueLoaderPlugin()
    ],

  };
};
