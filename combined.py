from flask import Flask, jsonify,request
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import linear_kernel
import random
from operator import itemgetter
from fuzzywuzzy import fuzz
from flask import Flask, request, jsonify
from flask_sqlalchemy import SQLAlchemy
from sklearn.feature_extraction.text import TfidfVectorizer
from sklearn.metrics.pairwise import cosine_similarity
import numpy as np
import nltk
from nltk.corpus import stopwords
from nltk.tokenize import word_tokenize
from nltk.corpus import wordnet
from scipy.sparse import vstack
app = Flask(__name__)

app.config['SQLALCHEMY_DATABASE_URI'] = 'mysql+pymysql://root:@localhost/LGMtravel'
app.config['SQLALCHEMY_TRACK_MODIFICATIONS'] = False
db = SQLAlchemy(app)

nltk.download('stopwords')
nltk.download('punkt')

class Package(db.Model):
    __tablename__ = 'packages'
    packageID = db.Column(db.String(255), primary_key=True)
    packageName = db.Column(db.String(255))
    packageImage = db.Column(db.String(255))
    highlight = db.Column(db.Text)
    itineraryPdf = db.Column(db.String(255))
    remarks = db.Column(db.Text)
    destination = db.Column(db.String(255))
    singleRoom = db.Column(db.Float)
    doubleRoom = db.Column(db.Float)
    tripleRoom = db.Column(db.Float)
    created_at = db.Column(db.TIMESTAMP, server_default=db.func.current_timestamp())

vectorizer = TfidfVectorizer(stop_words=stopwords.words('english'))

with app.app_context():
    packages = Package.query.all()

    def get_synonyms(word):
        synonyms = set()
        for syn in wordnet.synsets(word):
            for lemma in syn.lemmas():
                synonyms.add(lemma.name())
        return list(synonyms)

    def get_related_terms(word):
        synonyms = get_synonyms(word)
        
        all_related_terms = set([word])

        all_related_terms.update(synonyms)

       
        return ' '.join(all_related_terms)

    package_details = []
    for package in packages:
        details = f"{package.highlight}"

        expanded_details = []
        for word in details.split():
            synonyms = get_synonyms(word)
            related_terms = get_related_terms(word)

            expanded_details.extend([word] + synonyms + related_terms if isinstance(related_terms, list) else [related_terms])

        package_details.append(" ".join(expanded_details))

    package_matrix = vectorizer.fit_transform(package_details)

@app.route('/recommend', methods=['POST'])
def recommend():
    with app.app_context():
        data = request.get_json()

        print(f"Received data: {data}")

        user_preferences = {key: data.get(key, '') for key in ['season', 'activity', 'accommodation', 'destination', 'travelGroup']}

        user_related_terms = {key: get_related_terms(value) for key, value in user_preferences.items()}


        combined_user_preferences = ' '.join([str(value) + ' ' + ' '.join(map(str, related_terms)) if isinstance(related_terms, list) else str(value) for value, related_terms in zip(user_preferences.values(), user_related_terms.values())])

        user_vector = vectorizer.transform([combined_user_preferences])

        similarity_scores = cosine_similarity(user_vector, package_matrix).flatten()


        ranked_packages = [{'id': package.packageID, 'name': package.packageName, 'score': score}
                           for package, score in zip(packages, similarity_scores)]

        ranked_packages = sorted(ranked_packages, key=lambda x: x['score'], reverse=True)

        recommendations = [{'id': package['id'], 'name': package['name'], 'score': package['score']} for package in ranked_packages[:3]]

        return jsonify({'recommendations': recommendations})
    
data = [
    {'type': 'restaurant', 'name': 'Peking Duck House Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Indulge in the famous Peking Duck at Peking Duck House. Beijing'},
    {'type': 'attraction', 'name': 'Summer Palace Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Explore the historical Summer Palace with beautiful gardens. Beijing'},
    {'type': 'attraction', 'name': '798 Art District Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Immerse yourself in contemporary art at the 798 Art District. Beijing'},
    {'type': 'hotel', 'name': 'Imperial Palace Hotel Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Experience luxury at the Imperial Palace Hotel with a touch of imperial history. Beijing'},
    {'type': 'restaurant', 'name': 'Huangcheng Laoma Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Enjoy traditional Beijing cuisine at Huangcheng Laoma. Beijing'},
    {'type': 'attraction', 'name': 'Temple of Heaven Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Visit the iconic Temple of Heaven for its architectural beauty. Beijing'},
    {'type': 'hotel', 'name': 'Wangfujing Grand Hotel Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Stay in luxury at the Wangfujing Grand Hotel in the heart of Beijing. Beijing'},
    {'type': 'restaurant', 'name': 'Quanjude Roast Duck Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Savor delicious roast duck at Quanjude, a Beijing culinary institution. Beijing'},
    {'type': 'attraction', 'name': 'Lama Temple Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Explore the serene Lama Temple for a spiritual experience. Beijing'},
    {'type': 'restaurant', 'name': 'Jing Yaa Tang Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Indulge in modern Chinese cuisine at Jing Yaa Tang. Beijing'},
     {'type': 'restaurant', 'name': 'Duck de Chine Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Try exquisite Peking Duck at Duck de Chine. Beijing'},
    {'type': 'attraction', 'name': 'National Museum of China Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Explore Chinese history at the National Museum of China. Beijing'},
    {'type': 'hotel', 'name': 'The Peninsula Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Indulge in luxury at The Peninsula Beijing with world-class amenities. Beijing'},
    {'type': 'restaurant', 'name': 'Lost Heaven Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Experience Yunnan cuisine at Lost Heaven. Beijing'},
    {'type': 'attraction', 'name': 'Beihai Park Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Stroll through the scenic Beihai Park for a tranquil escape. Beijing'},
    {'type': 'hotel', 'name': 'Rosewood Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Enjoy a luxurious stay at Rosewood Beijing. Beijing'},
    {'type': 'restaurant', 'name': 'Jin Ding Xuan Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Delight in traditional dim sum at Jin Ding Xuan. Beijing'},
    {'type': 'attraction', 'name': 'Yonghe Lama Temple Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Visit the Yonghe Lama Temple for its cultural significance. Beijing'},
    {'type': 'restaurant', 'name': 'TRB Hutong Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Dine in a historic courtyard setting at TRB Hutong. Beijing'},
    {'type': 'restaurant', 'name': 'Green T. House Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Experience modern Chinese cuisine at Green T. House. Beijing'},
    {'type': 'restaurant', 'name': 'Da Dong Roast Duck Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Savor innovative Peking Duck at Da Dong. Beijing'},
    {'type': 'restaurant', 'name': 'Haidilao Hot Pot Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Enjoy interactive hot pot dining at Haidilao. Beijing'},
    {'type': 'attraction', 'name': 'Birds Nest Stadium Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Admire the iconic architecture of the Birds Nest Stadium. Beijing'},
    {'type': 'attraction', 'name': 'Jingshan Park Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Climb to the top of Jingshan Park for panoramic views of Beijing. Beijing'},
    {'type': 'hotel', 'name': 'Aman Summer Palace Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Experience luxury and tranquility at Aman Summer Palace. Beijing'},
    {'type': 'restaurant', 'name': 'Nanluoguxiang Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Explore the historic alleyways and dine at Nanluoguxiang. Beijing'},
    {'type': 'attraction', 'name': 'China National Film Museum Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Discover the history of Chinese cinema at the National Film Museum. Beijing'},
    {'type': 'hotel', 'name': 'Waldorf Astoria Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Indulge in luxury at the Waldorf Astoria in Beijing. Beijing'},
    {'type': 'restaurant', 'name': 'Dali Courtyard Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Experience traditional Chinese courtyard dining at Dali Courtyard. Beijing'},
    {'type': 'attraction', 'name': 'Beijing Olympic Park', 'destination': 'China', 'state': 'Beijing', 'info': 'Explore the site of the 2008 Beijing Olympics at Olympic Park. Beijing'},
    {'type': 'restaurant', 'name': 'Black Sesame Kitchen Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Enjoy a communal dining experience at Black Sesame Kitchen. Beijing'},
    {'type': 'restaurant', 'name': 'Kings Joy Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Savor vegetarian cuisine in an elegant setting at Kings Joy. Beijing'},
    {'type': 'attraction', 'name': 'Ming Tombs Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Visit the Ming Tombs to explore imperial mausoleums. Beijing'},
    {'type': 'hotel', 'name': 'The Opposite House Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Experience contemporary luxury at The Opposite House. Beijing'},
    {'type': 'restaurant', 'name': 'TRB Forbidden City Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Dine with a view of the Forbidden City at TRB. Beijing'},
    {'type': 'attraction', 'name': 'Yuanmingyuan Park Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Explore the ruins of the Old Summer Palace at Yuanmingyuan Park. Beijing'},
    {'type': 'restaurant', 'name': 'Maison Boulud Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Indulge in French-inspired cuisine at Maison Boulud. Beijing'},
    {'type': 'restaurant', 'name': 'Black Bamboo Park Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Relax and stroll through the scenic Black Bamboo Park. Beijing'},
    {'type': 'restaurant', 'name': 'Temple Restaurant Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Dine in a former temple at Temple Restaurant. Beijing'},
    {'type': 'restaurant', 'name': 'TRB Hutong Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Experience fine dining in a traditional Hutong setting at TRB. Beijing'},
    {'type': 'attraction', 'name': 'Chinese Ethnic Culture Park Beijing', 'destination': 'China', 'state': 'Beijing', 'info': 'Learn about China\'s ethnic diversity at the Ethnic Culture Park. Beijing'},
    {'type': 'restaurant', 'name': 'Shangxiajiu Pedestrian Street Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Explore a bustling shopping street at Shangxiajiu Pedestrian Street. Guangzhou'},
    {'type': 'attraction', 'name': 'Sun Yat-sen Memorial Hall Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Visit the memorial hall dedicated to Sun Yat-sen. Guangzhou'},
    {'type': 'hotel', 'name': 'The Westin Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Enjoy a comfortable stay at The Westin Guangzhou with city views. Guangzhou'},
    {'type': 'restaurant', 'name': 'White Swan Hotel Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Dine in elegance at White Swan Hotel. Guangzhou'},
    {'type': 'attraction', 'name': 'Yuexiu Park Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Discover nature and history at Yuexiu Park. Guangzhou'},
    {'type': 'hotel', 'name': 'Grand Hyatt Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Experience luxury at Grand Hyatt Guangzhou with modern amenities. Guangzhou'},
    {'type': 'restaurant', 'name': 'Wu Guanzhong Art Gallery Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Combine art and dining at Wu Guanzhong Art Gallery. Guangzhou'},
    {'type': 'attraction', 'name': 'Chen Clan Ancestral Hall Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Explore the cultural heritage at Chen Clan Ancestral Hall. Guangzhou'},
    {'type': 'restaurant', 'name': 'Panxi Restaurant Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Indulge in Cantonese cuisine at Panxi Restaurant. Guangzhou'},
    {'type': 'restaurant', 'name': 'Hai Zhu Shan Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Savor seafood delights at Hai Zhu Shan. Guangzhou'},
    {'type': 'restaurant', 'name': 'Canton Tower Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Dine with a view at the Canton Tower revolving restaurant. Guangzhou'},
    {'type': 'attraction', 'name': 'Chimelong Safari Park Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Experience wildlife at Chimelong Safari Park. Guangzhou'},
    {'type': 'attraction', 'name': 'Pearl River Cruise Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Take a scenic cruise along the Pearl River. Guangzhou'},
    {'type': 'hotel', 'name': 'The Ritz-Carlton Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Luxury awaits at The Ritz-Carlton in Guangzhou with stunning city views. Guangzhou'},
    {'type': 'restaurant', 'name': 'Shamian Island Tea House Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Enjoy tea and snacks in the historic Shamian Island Tea House. Guangzhou'},
    {'type': 'attraction', 'name': 'Guangzhou Opera House Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Admire the modern architecture of the Guangzhou Opera House. Guangzhou'},
    {'type': 'hotel', 'name': 'Four Seasons Hotel Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Experience luxury hospitality at the Four Seasons Hotel in Guangzhou. Guangzhou'},
    {'type': 'restaurant', 'name': 'DimDimSum Dim Sum Specialty Store Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Savor a variety of delicious dim sum at DimDimSum. Guangzhou'},
    {'type': 'attraction', 'name': 'Canton Fair Complex Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Explore exhibitions and events at the Canton Fair Complex. Guangzhou'},
    {'type': 'restaurant', 'name': 'Bing Sheng Mansion Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Experience traditional Cantonese cuisine at Bing Sheng Mansion. Guangzhou'},
     {'type': 'restaurant', 'name': 'Canton Tower Revolving Restaurant Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Dine with panoramic views at the revolving restaurant in Canton Tower. Guangzhou'},
    {'type': 'attraction', 'name': 'Guangzhou Zoo Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Explore diverse wildlife at Guangzhou Zoo. Guangzhou'},
    {'type': 'attraction', 'name': 'Shamian Island Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Stroll through the historic colonial architecture on Shamian Island. Guangzhou'},
    {'type': 'hotel', 'name': 'W Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Experience modern luxury at W Guangzhou with stylish amenities. Guangzhou'},
    {'type': 'restaurant', 'name': 'Yu Yue Heen Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Savor Cantonese delicacies at Yu Yue Heen. Guangzhou'},
    {'type': 'attraction', 'name': 'Chen Clan Ancestral Hall Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Admire traditional Chinese architecture at Chen Clan Ancestral Hall. Guangzhou'},
    {'type': 'hotel', 'name': 'The Ritz-Carlton, Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Indulge in luxury at The Ritz-Carlton in the heart of Guangzhou. Guangzhou'},
    {'type': 'restaurant', 'name': 'Panxi Restaurant Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Experience Guangzhou cuisine at Panxi Restaurant. Guangzhou'},
    {'type': 'attraction', 'name': 'Haizhu Lake Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Enjoy the scenic beauty of Haizhu Lake. Guangzhou'},
    {'type': 'restaurant', 'name': 'White Swan Hotel Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Dine in elegance at White Swan Hotel. Guangzhou'},
    {'type': 'restaurant', 'name': 'Dian Dou De Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Savor local flavors at Dian Dou De. Guangzhou'},
    {'type': 'attraction', 'name': 'Guangzhou Opera House Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Admire the modern architecture of the Guangzhou Opera House. Guangzhou'},
    {'type': 'hotel', 'name': 'Four Seasons Hotel Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Experience luxury hospitality at the Four Seasons Hotel. Guangzhou'},
    {'type': 'restaurant', 'name': 'Baiyun Mountain Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Hike and enjoy panoramic views from Baiyun Mountain. Guangzhou'},
    {'type': 'restaurant', 'name': 'Jade River Restaurant Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Indulge in Cantonese cuisine at Jade River Restaurant. Guangzhou'},
    {'type': 'attraction', 'name': 'Sun Yat-sen Memorial Hall Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Learn about Dr. Sun Yat-sen at the memorial hall. Guangzhou'},
    {'type': 'restaurant', 'name': 'Lai Heen Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Experience fine dining at Lai Heen. Guangzhou'},
    {'type': 'restaurant', 'name': 'Shangri-La Hotel Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Indulge in luxury at Shangri-La Hotel Guangzhou. Guangzhou'},
    {'type': 'attraction', 'name': 'Chimelong Paradise Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Enjoy thrilling rides and entertainment at Chimelong Paradise. Guangzhou'},
    {'type': 'restaurant', 'name': 'Guangzhou Tower Guangzhou', 'destination': 'China', 'state': 'Guangzhou', 'info': 'Dine with city views at Guangzhou Tower. Guangzhou'},
    {'type': 'restaurant', 'name': 'Nasi Kandar Line Clear Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Savor authentic Nasi Kandar at Line Clear in Penang. Penang'},
    {'type': 'attraction', 'name': 'Penang Hill Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Take a scenic funicular ride to the top of Penang Hill. Penang'},
    {'type': 'attraction', 'name': 'Penang Street Art Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Explore the vibrant street art scene in Penang. Penang'},
    {'type': 'hotel', 'name': 'Eastern & Oriental Hotel Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Experience colonial charm at the Eastern & Oriental Hotel. Penang'},
    {'type': 'restaurant', 'name': 'Gurney Drive Hawker Center Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Sample a variety of hawker delights at Gurney Drive. Penang'},
    {'type': 'attraction', 'name': 'Kek Lok Si Temple Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Visit the largest Buddhist temple in Malaysia, Kek Lok Si. Penang'},
    {'type': 'hotel', 'name': 'Shangri-Las Rasa Sayang Resort & Spa Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Relax in luxury at Shangri-La\'s Rasa Sayang Resort & Spa. Penang'},
    {'type': 'restaurant', 'name': 'Tek Sen Restaurant Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Indulge in Nyonya and Chinese cuisine at Tek Sen. Penang'},
    {'type': 'attraction', 'name': 'Cheong Fatt Tze Mansion (The Blue Mansion) Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Explore the historic Blue Mansion in Penang. Penang'},
    {'type': 'restaurant', 'name': 'Little India Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Immerse yourself in the vibrant culture of Little India in Penang. Penang'},
    {'type': 'restaurant', 'name': 'The Safe Room Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Dine in a unique setting at The Safe Room in Labuan. Labuan'},
    {'type': 'attraction', 'name': 'Labuan War Cemetery Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Pay respects at the historical Labuan War Cemetery. Labuan'},
    {'type': 'attraction', 'name': 'Papan Island Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Explore the natural beauty of Papan Island in Labuan. Labuan'},
    {'type': 'hotel', 'name': 'Dorsett Grand Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Experience modern comfort at Dorsett Grand Labuan. Labuan'},
    {'type': 'restaurant', 'name': 'Nagasaki Seafood Restaurant Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Savor fresh seafood at Nagasaki Seafood Restaurant in Labuan. Labuan'},
    {'type': 'attraction', 'name': 'Labuan International Sea Sports Complex Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Enjoy water sports and activities at the Sea Sports Complex. Labuan'},
    {'type': 'hotel', 'name': 'Tiara Labuan Hotel Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Stay at Tiara Labuan Hotel for a comfortable and convenient experience. Labuan'},
    {'type': 'restaurant', 'name': 'Aroi Thai Restaurant Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Delight in authentic Thai cuisine at Aroi Thai Restaurant. Labuan'},
    {'type': 'attraction', 'name': 'Labuan Museum Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Discover the history of Labuan at the Labuan Museum. Labuan'},
    {'type': 'restaurant', 'name': 'Waterfront Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Dine with a view of the waterfront in Labuan. Labuan'},
    {'type': 'restaurant', 'name': 'Ocean Paradise Seafood Restaurant Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Savor a variety of seafood dishes at Ocean Paradise Seafood Restaurant in Labuan. Labuan'},
    {'type': 'attraction', 'name': 'AnNur Jamek Mosque Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Visit the beautiful AnNur Jamek Mosque for its architectural splendor. Labuan'},
    {'type': 'attraction', 'name': 'Labuan Square Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Explore Labuan Square, a vibrant public space in the heart of the city. Labuan'},
    {'type': 'hotel', 'name': 'Palm Beach Resort & Spa Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Indulge in luxury at Palm Beach Resort & Spa, offering stunning ocean views. Labuan'},
    {'type': 'restaurant', 'name': 'Topspot Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Dine at Topspot for a unique culinary experience with a view. Labuan'},
    {'type': 'attraction', 'name': 'Labuan Chimney Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Learn about Labuans industrial history at the iconic Labuan Chimney. Labuan'},
    {'type': 'hotel', 'name': 'DMariner Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Experience comfortable accommodation and warm hospitality at DMariner. Labuan'},
    {'type': 'restaurant', 'name': 'Perdana Botanical Garden Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Enjoy a leisurely stroll in the scenic Perdana Botanical Garden. Labuan'},
    {'type': 'attraction', 'name': 'Labuan Bird Park Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Discover a variety of bird species at the charming Labuan Bird Park. Labuan'},
    {'type': 'restaurant', 'name': 'Nadiras Kitchen Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Delight in Malaysian and international cuisine at Nadiras Kitchen. Labuan'},
    {'type': 'restaurant', 'name': 'Red Garden Food Paradise Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Experience a culinary feast at Red Garden Food Paradise in Penang. Penang'},
    {'type': 'attraction', 'name': 'Penang National Park Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Explore the diverse flora and fauna at Penang National Park. Penang'},
    {'type': 'attraction', 'name': 'Penang Butterfly Farm Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Visit the enchanting Penang Butterfly Farm for a colorful experience. Penang'},
    {'type': 'hotel', 'name': 'Lexis Suites Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Indulge in luxury and comfort at Lexis Suites Penang. Penang'},
    {'type': 'restaurant', 'name': 'Tek Sen Restaurant Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Savor Nyonya and Chinese cuisine at Tek Sen Restaurant. Penang'},
    {'type': 'attraction', 'name': 'Penang Peranakan Mansion Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Discover the rich cultural heritage at the Penang Peranakan Mansion. Penang'},
    {'type': 'hotel', 'name': 'Eastern & Oriental Hotel Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Experience colonial elegance at the Eastern & Oriental Hotel. Penang'},
    {'type': 'restaurant', 'name': 'China House Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Indulge in delicious cakes and cuisine at the eclectic China House. Penang'},
    {'type': 'attraction', 'name': 'Street Art in George Town Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Stroll through George Town to admire its vibrant street art scene. Penang'},
    {'type': 'restaurant', 'name': 'Kebaya Dining Room Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Dine in a charming setting at Kebaya Dining Room in Penang. Penang'},
     {'type': 'attraction', 'name': 'Labuan Water Village', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Explore the unique Labuan Water Village for a cultural experience. Labuan'},
    {'type': 'restaurant', 'name': 'Sunset Grill Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Dine with a view of the sunset at Sunset Grill in Labuan. Labuan'},
    {'type': 'attraction', 'name': 'Labuan International Golf Club', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Enjoy a round of golf with scenic views at Labuan International Golf Club. Labuan'},
    {'type': 'restaurant', 'name': 'Flavors of Borneo Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Savor the diverse flavors of Borneo at Flavors of Borneo restaurant. Labuan'},
    {'type': 'attraction', 'name': 'Labuan Financial Park', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Discover the modern and vibrant Labuan Financial Park. Labuan'},
    {'type': 'restaurant', 'name': 'Ocean View Seafood Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Indulge in fresh seafood with an ocean view at Ocean View Seafood in Labuan. Labuan'},
       {'type': 'attraction', 'name': 'Penang Avatar Secret Garden', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Experience a magical light display at the Penang Avatar Secret Garden. Penang'},
    {'type': 'restaurant', 'name': 'Top Hat Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Dine in elegance and style at Top Hat in Penang. Penang'},
    {'type': 'attraction', 'name': 'Penang Time Tunnel Museum', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Step into the past at the Penang Time Tunnel Museum. Penang'},
    {'type': 'restaurant', 'name': 'Perut Rumah Nonya Cuisine Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Savor authentic Peranakan cuisine at Perut Rumah Nonya Cuisine. Penang'},
    {'type': 'restaurant', 'name': 'The Alley Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Indulge in trendy and delicious bubble tea at The Alley in Penang. Penang'},
     {'type': 'attraction', 'name': 'Labuan Waterfront', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Enjoy a relaxing stroll along the picturesque Labuan Waterfront. Labuan'},
    {'type': 'restaurant', 'name': 'Sea Breeze Café Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Dine with a sea breeze at Sea Breeze Café in Labuan. Labuan'},
    {'type': 'attraction', 'name': 'Labuan Marine Park', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Discover the underwater beauty of Labuan Marine Park through snorkeling or diving. Labuan'},
    {'type': 'restaurant', 'name': 'Borneo Flavors Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Experience the rich flavors of Borneo at Borneo Flavors restaurant. Labuan'},
    {'type': 'attraction', 'name': 'Labuan Warisan Square', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Shop and explore local culture at Labuan Warisan Square. Labuan'},
    {'type': 'restaurant', 'name': 'Sunrise Bistro Labuan', 'destination': 'Malaysia', 'state': 'Labuan', 'info': 'Start your day with a delightful breakfast at Sunrise Bistro in Labuan. Labuan'},
    {'type': 'restaurant', 'name': 'Seven Terraces Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Dine in a colonial-era mansion at Seven Terraces in Penang. Penang'},
    {'type': 'attraction', 'name': 'Penang Peranakan Museum', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Explore the rich Peranakan culture at the Penang Peranakan Museum. Penang'},
    {'type': 'restaurant', 'name': 'ChinaHouse Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Indulge in a unique dining experience at ChinaHouse in Penang. Penang'},
    {'type': 'attraction', 'name': 'Penang Interactive 3D Museum', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Have fun and take creative photos at the Penang Interactive 3D Museum. Penang'},
    {'type': 'restaurant', 'name': 'Jawi House Penang', 'destination': 'Malaysia', 'state': 'Penang', 'info': 'Experience traditional Jawi and Malay cuisine at Jawi House in Penang. Penang'},
]


def recommend_itinerary(user_preferences, destination, num_days):
    destination_data = filter_by_destination(data, destination)

    print(f"Destination Data: {destination_data}, Days: {num_days}")

    corpus = [f"{item['destination']} {item['name']} {item['info']}" for item in destination_data]
    vectorizer = TfidfVectorizer()
    tfidf_matrix = vectorizer.fit_transform(corpus)

    recommended_attractions = set()
    recommended_restaurants = set()
    recommended_hotels = set()
    itinerary_status = True

    print(f"Destination Data: {recommended_attractions}, Days: {num_days}")
    

    user_vector = vectorizer.transform([f"{destination} {user_preferences['season']} {user_preferences['activity']} {user_preferences['accommodation']} {user_preferences['travelGroup']}"])
    cosine_similarities = linear_kernel(user_vector, tfidf_matrix).flatten()
    sorted_data = sorted(zip(cosine_similarities, destination_data), key=lambda x: x[0], reverse=True)

    matching_items = [item for score, item in sorted_data if item['name'] not in recommended_attractions and item['name'] not in recommended_restaurants and item['name'] not in recommended_hotels]
    non_matching_items = [item for score, item in sorted_data if item['name'] in recommended_attractions or item['name'] in recommended_restaurants or item['name'] in recommended_hotels]

    random.shuffle(matching_items)

    shuffled_data = matching_items + non_matching_items

    itinerary = {'country': destination, 'num_days': num_days, 'days': []}
    total_days = min(num_days, len(shuffled_data)) 

    for i in range(total_days):
        day_info = {'day': i + 1, 'recommendations': []}

        restaurant_found = False
        attraction_found = False
        restaurant_found_lunch = False
        attraction_found_afternoon = False
        restaurant_found_dinner = False

        for meal_type in ['Breakfast']:
            for item in shuffled_data:
                if item['type'] == 'restaurant' and item['name'] not in recommended_restaurants:
                    score = next(score for score, data_item in sorted_data if data_item['name'] == item['name'])
                    recommendation = f"For {meal_type.lower()}, you can visit {item['name']}. {item['info']}"
                    day_info['recommendations'].append(recommendation)
                    recommended_restaurants.add(item['name'])
                    restaurant_found = True
                    break

        for item in shuffled_data:
            if item['type'] == 'attraction' and item['name'] not in recommended_attractions:
                score = next(score for score, data_item in sorted_data if data_item['name'] == item['name'])
                recommendation = f"After breakfast, visit {item['name']}. {item['info']}"
                day_info['recommendations'].append(recommendation)
                recommended_attractions.add(item['name'])
                attraction_found = True
                break  
       
        for meal_type in ['Lunch']:
            for item in shuffled_data:
                if item['type'] == 'restaurant' and item['name'] not in recommended_restaurants:
                    score = next(score for score, data_item in sorted_data if data_item['name'] == item['name'])
                    recommendation = f"Then you can have your {meal_type.lower()} at {item['name']}. {item['info']}"
                    day_info['recommendations'].append(recommendation)
                    recommended_restaurants.add(item['name'])
                    restaurant_found_lunch = True
                    break

        for item in shuffled_data:
            if item['type'] == 'attraction' and item['name'] not in recommended_attractions:
                score = next(score for score, data_item in sorted_data if data_item['name'] == item['name'])
                recommendation = f"After lunch, you can visit {item['name']}. {item['info']}"
                day_info['recommendations'].append(recommendation)
                recommended_attractions.add(item['name'])
                attraction_found_afternoon = True
                break  

        for meal_type in ['Dinner']:
            for item in shuffled_data:
                if item['type'] == 'restaurant' and item['name'] not in recommended_restaurants:
                    score = next(score for score, data_item in sorted_data if data_item['name'] == item['name'])
                    recommendation = f"For {meal_type.lower()}, you can visit {item['name']}. {item['info']}"
                    day_info['recommendations'].append(recommendation)
                    recommended_restaurants.add(item['name'])
                    restaurant_found_dinner = True
                    break

        for item in shuffled_data:
             if item['type'] == 'hotel' and item['name'] not in recommended_hotels:
                recommended_hotels.add(item['name'])
                break

        if not (restaurant_found and attraction_found and restaurant_found_lunch and attraction_found_afternoon and restaurant_found_dinner):
            itinerary_status = False
            print(f"Data for day {i + 1} is not sufficient. Skipping the generation of the itinerary for this day.")
            continue

        itinerary['days'].append(day_info)

        print(f"Day {i + 1} Recommendations:")
        for recommendation in day_info['recommendations']:
            print(recommendation)

    print("\nHotel Recommendations:")
    for item in shuffled_data:
        if item['type'] == 'hotel' and item['name'] in recommended_hotels:
            score = next(score for score, data_item in sorted_data if data_item['name'] == item['name'])
            recommendation = f"You can stay at {item['name']} with a similarity score of {score:.2f}. {item['info']}"
            print(recommendation)


    return itinerary,list(recommended_hotels),itinerary_status

def generate_random_preferences():
    seasons = ['Spring', 'Summer', 'Fall', 'Winter']
    activities = ['Art', 'History', 'Nature', 'Adventure']
    accommodations = ['Hotel', 'Resort', 'Cottage', 'Hostel']
    destinations = ['Beach', 'Mountain', 'City', 'Countryside']
    travel_groups = ['Solo', 'Couple', 'Family', 'Friends']

    random_preferences = {
        'season': random.choice(seasons),
        'activity': random.choice(activities),
        'accommodation': random.choice(accommodations),
        'destination': random.choice(destinations),
        'travelGroup': random.choice(travel_groups)
    }

    return random_preferences

def filter_by_destination(items, destination):
    return [item for item in items if destination.lower() in item['destination'].lower() or destination.lower() in item['state'].lower()]

def random_state_for_destination(destination):
    states_for_destination = set(item['state'] for item in data if destination.lower() in item['destination'].lower())
    if states_for_destination:
        return random.choice(list(states_for_destination))
    return None

@app.route('/generate_itinerary/<string:country>', methods=['GET'])
def generate_itinerary(country):
    user_preferences = {
        'season': '',
        'activity': '',
        'accommodation': '',
        'destination': '',
        'travelGroup': ''
    }
    num_days = request.args.get('days', type=int, default=1)

    print(f"Country: {country}, Days: {num_days}")

    if user_preferences is None:
        user_preferences = generate_random_preferences()

    
    # Initialize variables to track the best matching location and its similarity score
    best_match = None
    best_score = 0
    # Loop through unique state values in the 'data' list and calculate similarity scores
    for known_location in set(item['state'] for item in data):
        # Use the fuzzy string matching ratio to calculate the similarity score
        similarity_score = fuzz.ratio(country, known_location.lower())
        # Check if the current similarity score is higher than the best score
        if similarity_score > best_score:
            best_score = similarity_score
            best_match = known_location
    # If the best similarity score is below threshold(80), attempt to find a match using destination names
    if best_score < 80:
        for known_location in set(item['destination'] for item in data):
            similarity_score = fuzz.ratio(country.lower(), known_location.lower())
            
            # Check if the current similarity score is higher than the best score
            if similarity_score > best_score:
                best_score = similarity_score
                # Get random state with that is same as the destination
                best_match = random_state_for_destination(known_location)

    # If the best similarity score is still below the threshold(80), return an error response
    if best_score < 80:
        return jsonify({'error': f"Location '{country}' is not in our database or being recognized. Did you mean '{best_match}'?"}), 400

    # If no best match is found, return an error response
    if best_match is None:
        error_message = "Hmm, are you sure that's a real place? Please try again."
        return jsonify({'error': error_message}), 400
    #This printing is for my own checking purpose
    print(f"Country: {best_match}, Days: {num_days}")

    itinerary = recommend_itinerary(user_preferences, best_match, num_days)
    #return the itinerary generated
    return jsonify(itinerary)

if __name__ == '__main__':
    from waitress import serve
    serve(app, host="0.0.0.0", port=5000)
