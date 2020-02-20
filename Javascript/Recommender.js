// Constructor for recommender object
export class Recommender {
  // Holds keywords
  keywords = {};

  // Keywords older than this window will be deleted
  timeWindow = 10000;

  constructor() {
    this.load();
  }

  // Add keyword to recommender
  addKeyword(word) {
    // Increase count of keyword
    if (this.keywords[word] === undefined) {
      this.keywords[word] = { count: 1, date: new Date().getTime() };
    } else {
      this.keywords[word].count++;
      this.keywords[word].date = new Date().getTime();
    }

    console.log(JSON.stringify(this.keywords));

    // Save state of recommender
    this.save();
  }

  // Return popular keyword
  getTopKeyword() {
    // Clean old keywords
    this.deleleOldKeywords();

    // Return word with highest count
    let maxCount = 0;
    let maxKeyword = "";
    for (let word in this.keywords) {
      if (this.keywords[word].count > maxCount) {
        maxCount = this.keywords[word].count;
        maxKeyword = word;
      }
    }
    return maxKeyword;
  }

  /*
    Saves state of recommender.  
    */
  save() {
    localStorage.recommenderKeywords === JSON.stringify(this.keywords);
  }

  /*
    Loads state of recommender.
    */
  load() {
    if (localStorage.recommenderKeywords === undefined) {
      this.keywords = {};
    } else {
      this.keywords = JSON.parse(localStorage.recommenderKeywords);
    }

    this.deleleOldKeywords();
  }

  // Removes keywords older than time window.
  deleleOldKeywords() {
    let currentTimeMillis = new Date().getTime();
    for (let word in this.keywords) {
      if (currentTimeMillis - this.keywords[word].date > this.timeWindow) {
        delete this.keywords[word];
      }
    }
    this.save();
  }
}
