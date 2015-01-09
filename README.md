# Client for Apigility Restful API

[![Build Status](https://travis-ci.org/guilhermewop/apigility-client.svg?branch=travis-support)](https://travis-ci.org/guilhermewop/apigility-client)
[![Scrutinizer Code Quality](https://scrutinizer-ci.com/g/guilhermewop/apigility-client/badges/quality-score.png?b=develop)](https://scrutinizer-ci.com/g/guilhermewop/apigility-client/?branch=develop)
[![Code Coverage](https://scrutinizer-ci.com/g/guilhermewop/apigility-client/badges/coverage.png?b=develop)](https://scrutinizer-ci.com/g/guilhermewop/apigility-client/?branch=develop)
[![Software License](https://img.shields.io/badge/license-MIT-brightgreen.svg?style=flat-square)](LICENSE)

## Goals

* Endpoint/Resource
 * Version
 * Links (self, first, next, last, etc) (:heavy_check_mark:)
 * Pagination (page size, page count, total items) (:heavy_check_mark:)
 * Embedded (main content, children resources)  
 * Formats  
    * Hal+json (:heavy_check_mark:)
     * Json
 * Requests  
    * fetch
    * insert
    * update
    * delete


* Http Client
 * Authentication (Injecting a http client)
 * Validate headers (Content type request/response)
 * Methods  
    * GET
    * POST
    * PUT
    * PATCH
    * DELETE
