/**
 * Multi-Language Translation Engine for Dwarka Tourism & Pilgrimage Portal
 * Supported Languages in <select> Dropdown:
 * - 'gu' : ગુજરાતી (Gujarati - Default)
 * - 'hi' : हिन्दी (Hindi)
 * - 'en' : English
 */

window.currentLang = localStorage.getItem('dwarka_lang') || 'gu';
if (!['gu', 'hi', 'en'].includes(window.currentLang)) {
    window.currentLang = 'gu';
}

const DWARKA_TRANSLATIONS = {
    // ================= 1. Top Bar & Header Navigation =================
    "જય શ્રી દ્વારકાધીશ! પવિત્ર મોક્ષપુરી અને ચાર ધામ પૈકીનું પશ્ચિમ ધામ.": {
        hi: "जय श्री द्वारकाधीश! पवित्र मोक्षपुरी और चार धामों में से पश्चिम धाम।",
        en: "Jay Shree Dwarkadhish! Sacred Mokshapuri & the Western Dham among Char Dhams."
    },
    "ઘંટનાદ (Temple Bell)": {
        hi: "घंटानाद (Temple Bell)",
        en: "Temple Bell"
    },
    "એડમિન": {
        hi: "एडमिन",
        en: "Admin"
    },
    "દ્વારકા દર્શન": {
        hi: "द्वारका दर्शन",
        en: "Dwarka Darshan"
    },
    "ઇન્સ્ટોલ એપ": {
        hi: "ऐप इंस्टॉल करें",
        en: "Install App"
    },
    "એપ ઇન્સ્ટોલ છે": {
        hi: "ऐप इंस्टॉल है",
        en: "App Installed"
    },
    "હોમ": {
        hi: "होम",
        en: "Home"
    },
    "દર્શન-આરતી": {
        hi: "दर्शन-आरती",
        en: "Darshan"
    },
    "સ્થળો": {
        hi: "स्थल",
        en: "Places"
    },
    "ટૂર પ્લાન": {
        hi: "टૂર પ્લાન",
        en: "Tour Plan"
    },
    "બજેટ": {
        hi: "बजट",
        en: "Budget"
    },
    "દ્વારકા શું છે?": {
        hi: "द्वारका क्या है?",
        en: "What is Dwarka?"
    },
    "મુખ્ય મંદિર & આરતી": {
        hi: "मुख्य मंदिर & आरती",
        en: "Main Temple & Aarti"
    },
    "ઇતિહાસ": {
        hi: "इतिहास",
        en: "History"
    },
    "જોવાલાયક સ્થળો": {
        hi: "दर्शनीय स्थल",
        en: "Places to Visit"
    },
    "સમયપત્રક": {
        hi: "समय-सारणी",
        en: "Itinerary"
    },
    "બજેટ & ભોજન": {
        hi: "बजट & भोजन",
        en: "Budget & Food"
    },
    "કેવી રીતે પહોંચવું": {
        hi: "कैसे पहुँचें",
        en: "How to Reach"
    },
    "યાત્રી પ્રતિભાવ": {
        hi: "यात्री प्रतिक्रिया",
        en: "Pilgrim Reviews"
    },

    // ================= 2. Hero Banner & Stats =================
    "હિન્દુ ધર્મના પવિત્ર ચાર ધામ પૈકીનું પશ્ચિમ ધામ": {
        hi: "हिन्दू धर्म के पवित्र चार धामों में से प्रमुख पश्चिम धाम",
        en: "Sacred Western Dham of Hinduism's Four Holy Char Dhams"
    },
    "દ્વારકાધીશ જગત મંદિર, ૫૨ ગજની ધજાનું આધ્યાત્મિક રહસ્ય, ગોમતી ઘાટ, બેટ દ્વારકા, શિવરાજપુર બીચ, નાગેશ્વર જ્યોતિર્લિંગ, સંપૂર્ણ પ્રવાસ સમયપત્રક, નોર્મલ હોટેલ અને ગુજરાતી કાઠિયાવાડી ભોજન બજેટની અધિકૃત માર્ગદર્શિકા.": {
        hi: "द्वारकाधीश जगत मंदिर, ५२ गज की ध्वजा का आध्यात्मिक रहस्य, गोमती घाट, बेट द्वारका, शिवराजपुर बीच, नागेश्वर ज्योतिर्लिंग, संपूर्ण यात्रा समय-सारणी, सामान्य होटल और गुजराती काठियावाड़ी भोजन बजट की आधिकारिक मार्गदर्शिका।",
        en: "Official pilgrimage & travel guide to Dwarkadhish Jagat Mandir, the spiritual mystery of the 52-Gaj Dhwaja, Gomti Ghat, Beyt Dwarka, Shivrajpur Beach, Nageshwar Jyotirlinga, complete tour itineraries, normal hotels & Gujarati Kathiyawadi food budget."
    },
    "લાઈવ બજેટ ગણો": {
        hi: "लाइव बजट गणना करें",
        en: "Calculate Live Budget"
    },
    "ટૂર સમયપત્રક જુઓ": {
        hi: "टूर समय-सारणी देखें",
        en: "View Tour Itinerary"
    },
    "ચાર ધામ": {
        hi: "चार धाम",
        en: "Char Dham"
    },
    "બદ્રીનાથ, પુરી, રામેશ્વરમ સાથે મોક્ષદાયી": {
        hi: "बद्रीनाथ, पुरी, रामेश्वरम के साथ मोक्षदायी धाम",
        en: "Sacred Moksha Dham along with Badrinath, Puri & Rameswaram"
    },
    "૫૨ ગજ": {
        hi: "५२ गज",
        en: "52 Gaj"
    },
    "શિખર પર દિવસમાં ૬ વખત ચઢાવવામાં આવતી ધજા": {
        hi: "शिखर पर दिन में ६ बार चढ़ाई जाने वाली भव्य ध्वजा",
        en: "Sacred flag hoisted 6 times a day atop the temple Shikhara"
    },
    "શિખર પર દિવસમાં ૫ વખત બદલાતી ધજા": {
        hi: "शिखर पर दिन में ६ बार चढ़ाई जाने वाली भव्य ध्वजा",
        en: "Sacred flag hoisted 6 times a day atop the temple Shikhara"
    },
    "૫૦૦૦+ વર્ષ": {
        hi: "५०००+ वर्ष",
        en: "5000+ Years"
    },
    "મહાભારત કાળ અને સમુદ્ર તળેના અવશેષો": {
        hi: "महाभारत काल और समुद्र तल के प्राचीन अवशेष",
        en: "Mahabharata era heritage & underwater archaeological remains"
    },
    "૨૫ લાખ+": {
        hi: "२५ लाख+",
        en: "2.5 Million+"
    },
    "વાર્ષિક દર્શનાર્થીઓ અને શ્રદ્ધાળુઓ": {
        hi: "वार्षिक दर्शनार्थी और श्रद्धालु",
        en: "Annual pilgrims and devotees visiting Dwarka"
    },

    // ================= 3. Section: What is Dwarka? =================
    "પરિચય અને મહત્વ": {
        hi: "परिचय और महत्व",
        en: "Introduction & Significance"
    },
    "દ્વારકા શું છે? (What is Dwarka?)": {
        hi: "द्वारका क्या है? (What is Dwarka?)",
        en: "What is Dwarka?"
    },
    "દ્વારકા એટલે \"મોક્ષનું દ્વાર\" — ભગવાન શ્રીકૃષ્ણની કર્મભૂમિ, સુવર્ણ રાજધાની અને સનાતન સંસ્કૃતિનું પરમ પવિત્ર કેન્દ્ર.": {
        hi: "द्वारका अर्थात \"मोक्ष का द्वार\" — भगवान श्रीकृष्ण की कर्मभूमि, स्वर्ण राजधानी और सनातन संस्कृति का परम पवित्र केंद्र।",
        en: "Dwarka means \"Gateway to Liberation (Moksha)\" — the sacred karmabhoomi of Lord Shree Krishna, His golden capital, and a supreme center of Sanatan culture."
    },
    "પવિત્ર ચાર ધામ પૈકીનું એક": {
        hi: "पवित्र चार धामों में से एक",
        en: "One of the Sacred Char Dhams"
    },
    "આદિ શંકરાચાર્ય દ્વારા નિર્ધારિત ભારતના ચાર પરમ પવિત્ર ધામોમાં દ્વારકા પશ્ચિમ દિશાનું મુખ્ય ધામ છે. જીવનમાં એકવાર દ્વારકા યાત્રા કરવાથી જન્મ-મરણના ફેરામાંથી મુક્તિ મળે છે તેવી અતૂટ ધાર્મિક માન્યતા છે.": {
        hi: "आदि शंकराचार्य द्वारा निर्धारित भारत के चार परम पवित्र धामों में द्वारका पश्चिम दिशा का मुख्य धाम है। जीवन में एक बार द्वारका यात्रा करने से जन्म-मरण के चक्र से मुक्ति मिलती है, ऐसी अटूट धार्मिक मान्यता है।",
        en: "Among the four supreme pilgrimage sites established by Adi Shankaracharya, Dwarka is the principal Western Dham. It is deeply believed that visiting Dwarka once in a lifetime liberates the soul from the cycle of birth and rebirth."
    },
    "સપ્ત મોક્ષદાયી પુરી": {
        hi: "सप्त मोक्षदायी पुरी",
        en: "Sapta Mokshapuri (Seven Sacred Cities)"
    },
    "શ્રીકૃષ્ણની સુવર્ણ નગરી": {
        hi: "श्रीकृष्ण की स्वर्ण नगरी",
        en: "Golden Kingdom of Lord Krishna"
    },
    "મથુરા છોડ્યા બાદ ભગવાન શ્રીકૃષ્ણએ યાદવ સેના અને પ્રજાના રક્ષણ માટે સૌરાષ્ટ્રના પશ્ચિમ સાગરકાંઠે દેવશિલ્પી વિશ્વકર્મા પાસે સ્વર્ણ દ્વારકાનું નિર્માણ કરાવ્યું હતું, જ્યાં શ્રીકૃષ્ણ રાજાધિરાજ તરીકે પૂજાયા.": {
        hi: "मथुरा छोड़ने के बाद भगवान श्रीकृष्ण ने यादव सेना और प्रजा की रक्षा के लिए सौराष्ट्र के पश्चिमी समुद्र तट पर देवशिल्पी विश्वकर्मा से स्वर्ण द्वारका का निर्माण करवाया था, जहाँ श्रीकृष्ण राजाधिराज के रूप में पूजे गए।",
        en: "After leaving Mathura, to protect the Yadava clan and citizens, Lord Krishna had the celestial architect Vishwakarma build the Golden City of Dwarka on the western coast of Saurashtra, where He reigned as Rajadhiraj (King of Kings)."
    },
    "ગોમતી-સાગર સંગમ": {
        hi: "गोमती-सागर संगम",
        en: "Gomti River & Ocean Confluence"
    },
    "દ્વારકામાં પવિત્ર ગોમતી નદી અને અરબી સમુદ્રનો અદ્ભુત સંગમ થાય છે. ગોમતી ઘાટ પર સ્નાન કરી ૫૬ પગથિયાં ચઢી સ્વર્ગ દ્વારથી મંદિરમાં દર્શન કરવા જવાની પૌરાણિક પરંપરા વર્ષોથી ચાલી આવે છે.": {
        hi: "द्वारका में पवित्र गोमती नदी और अरब सागर का अद्भुत संगम होता है। गोमती घाट पर पवित्र स्नान कर ५६ सीढ़ियाँ चढ़कर स्वर्ग द्वार से मंदिर में दर्शन करने जाने की पौराणिक परंपरा सदियों से चली आ रही है।",
        en: "Dwarka witnesses the sacred confluence of the holy Gomti River and the Arabian Sea. Taking a holy dip at Gomti Ghat and ascending 56 steps to enter the temple via Swarga Dwar is an ancient spiritual tradition."
    },

    // ================= 4. Section: Main Temple & Aarti =================
    "મુખ્ય આરાધ્ય દેવ": {
        hi: "मुख्य आराध्य देव",
        en: "Presiding Deity"
    },
    "દ્વારકામાં કયા ભગવાનનું મંદિર છે?": {
        hi: "द्वारका में किस भगवान का मंदिर है?",
        en: "Which Deity's Temple is in Dwarka?"
    },
    "મૂળ નિર્માણ: શ્રીકૃષ્ણના પ્રપૌત્ર વજ્રનાભ દ્વારા": {
        hi: "मूल निर्माण: श्रीकृष्ण के प्रपौत्र वज्रनाभ द्वारा",
        en: "Originally Built By: Vajranabha (Great-Grandson of Lord Krishna)"
    },
    "મુખ્ય દેવ: ભગવાન શ્રીકૃષ્ણ (દ્વારકાધીશ - ચતુર્ભુજ રૂપ)": {
        hi: "मुख्य देव: भगवान श्रीकृष्ण (द्वारकाधीश - चतुर्भुज स्वरूप)",
        en: "Main Deity: Lord Shree Krishna (Dwarkadhish - Four-Armed Form)"
    },
    "શ્રી દ્વારકાધીશ જગત મંદિર (ત્રિલોક સુંદર)": {
        hi: "श्री द्वारकाधीश जगत मंदिर (त्रिलोक सुंदर)",
        en: "Shree Dwarkadhish Jagat Mandir (Trilok Sundar)"
    },
    "આ મંદિર ૫ માળનું ભવ્ય સ્થાપત્ય છે જે ચૂનાના પથ્થરોથી બનેલું છે અને ૭૨ કલાત્મક સ્તંભો પર ટકેલું છે. ગર્ભગૃહમાં કાળા કસોટીના પથ્થરથી કંડારેલી ભગવાન શ્રીકૃષ્ણની ચતુર્ભુજ શ્યામ મૂર્તિ બિરાજમાન છે, જેમના ચાર હાથમાં શંખ, સુદર્શન ચક્ર, ગદા અને પદ્મ (કમળ) સુશોભિત છે.": {
        hi: "यह मंदिर ५ मंजिला भव्य स्थापत्य है जो चूना पत्थर से बना है और ७२ कलात्मक स्तंभों पर टिका है। गर्भगृह में काले कसौटी पत्थर से निर्मित भगवान श्रीकृष्ण की चतुर्भुज श्याम मूर्ति विराजमान है, जिनके चारों हाथों में शंख, सुदर्शन चक्र, गदा और पद्म (कमल) सुशोभित हैं।",
        en: "This grand 5-storey architectural marvel is carved from limestone and supported by 72 ornate pillars. The sanctum enshrines a mesmerizing four-armed black stone idol of Lord Trivikrama (Krishna) holding the Shankha (Conch), Sudarshan Chakra, Gada (Mace), and Padma (Lotus)."
    },
    "દર્શન & આરતી સમયપત્રક જુઓ": {
        hi: "दर्शन & आरती समय-सारणी देखें",
        en: "View Darshan & Aarti Schedule"
    },
    "દ્વારકાધીશ મંદિર દર્શન અને આરતીનો દૈનિક સમય": {
        hi: "द्वारकाधीश मंदिर दर्शन और आरती का दैनिक समय",
        en: "Dwarkadhish Temple Daily Darshan & Aarti Timings"
    },
    "મંદિર સવારે ૬:૩૦ થી બપોરે ૧:૦૦ અને સાંજે ૫:૦૦ થી રાત્રે ૯:૩૦ વાગ્યા સુધી દર્શન માટે ખુલ્લું રહે છે.": {
        hi: "मंदिर सुबह ६:३० से दोपहर १:०० बजे तक और शाम ५:०० से रात ९:३० बजे तक दर्शन के लिए खुला रहता है।",
        en: "The temple remains open for devotees from 6:30 AM to 1:00 PM and from 5:00 PM to 9:30 PM daily."
    },
    "દૈનિક પૂજા ક્રમ": {
        hi: "दैनिक पूजा क्रम",
        en: "Daily Worship Schedule"
    },
    "આરતી / દર્શનનું નામ": {
        hi: "आरती / दर्शन का नाम",
        en: "Aarti / Darshan Name"
    },
    "સમય (Timing)": {
        hi: "समय (Timing)",
        en: "Timing"
    },
    "ધાર્મિક મહત્વ અને વિગત": {
        hi: "धार्मिक महत्व और विवरण",
        en: "Religious Significance & Details"
    },

    // Aarti Rows
    "મંગળા આરતી (Mangla Aarti)": {
        hi: "मंगला आरती (Mangla Aarti)",
        en: "Mangla Aarti"
    },
    "સવારે ૬:૩૦ વાગ્યે": {
        hi: "सुबह ६:३० बजे",
        en: "6:30 AM"
    },
    "પ્રભાત કાળે ભગવાનને જગાડીને કરવામાં આવતી પ્રથમ મંગલકારી દિવ્ય આરતી.": {
        hi: "प्रभात काल में भगवान को जगाकर की जाने वाली प्रथम मंगलकारी दिव्य आरती।",
        en: "The auspicious first morning Aarti performed at dawn to awaken the Lord."
    },
    "શૃંગાર દર્શન & આરતી (Shringar Aarti)": {
        hi: "शृंगार दर्शन & आरती (Shringar Aarti)",
        en: "Shringar Darshan & Aarti"
    },
    "સવારે ૭:૩૦ થી ૮:૦૦ વાગ્યે": {
        hi: "सुबह ७:३૦ से ८:०० बजे",
        en: "7:30 AM - 8:00 AM"
    },
    "ભગવાન શ્રીકૃષ્ણનું સિંહાસન પર પીતાંબર, મોરપીંછ અને સુવર્ણ આભૂષણો સાથે અલૌકિક શૃંગાર.": {
        hi: "सिंहासन पर भगवान श्रीकृष्ण का पीतांबर, मोरपंख और स्वर्ण आभूषणों के साथ अलौकिक शृंगार।",
        en: "Divine adornment of Lord Krishna on His throne with Pitambar robes, peacock feather, and golden ornaments."
    },
    "રાજભોગ દર્શન & આરતી (Rajbhog Aarti)": {
        hi: "राजभोग दर्शन & आरती (Rajbhog Aarti)",
        en: "Rajbhog Darshan & Aarti"
    },
    "બપોરે ૧૨:૦૦ થી ૧૨:૩૦ વાગ્યે": {
        hi: "दोपहर १२:०० से १२:३० बजे",
        en: "12:00 PM - 12:30 PM"
    },
    "ઠાકોરજીને ૫૬ ભોગ અને રાજભોગ ધરાવીને કરવામાં આવતી ભવ્ય આરતી (૧:૦૦ વાગ્યે મંદિર મંગલ થાય છે).": {
        hi: "ठाकुरजी को ५६ भोग और राजभोग अर्पित करके की जाने वाली भव्य आरती (दोपहर १:०० बजे मंदिर बंद होता है)।",
        en: "Grand midday Aarti after offering royal feast & Chhappan Bhog to the Lord (Temple closes at 1:00 PM for afternoon rest)."
    },
    "ઉત્થાપન દર્શન (Utthapan)": {
        hi: "उत्थापन दर्शन (Utthapan)",
        en: "Utthapan Darshan"
    },
    "સાંજે ૫:૦૦ વાગ્યે": {
        hi: "शाम ५:०० बजे",
        en: "5:00 PM"
    },
    "બપોરના વિશ્રામ બાદ સાંજે ભક્તો માટે પુનઃ મંદિરના કપાટ ખુલે છે.": {
        hi: "दोपहर के विश्राम के बाद शाम को भक्तों के लिए पुनः मंदिर के कपाट खुलते हैं।",
        en: "The temple doors reopen for devotees in the evening after the Lord's afternoon rest."
    },
    "સંધ્યા આરતી (Sandhya Aarti)": {
        hi: "संध्या आरती (Sandhya Aarti)",
        en: "Sandhya Aarti"
    },
    "સાંજે ૭:૩૦ થી ૭:૪૫ વાગ્યે": {
        hi: "शाम ७:३० से ७:४५ बजे",
        en: "7:30 PM - 7:45 PM"
    },
    "સૂર્યાસ્ત સમયે દીપમાળા પ્રગટાવીને થતી ભવ્ય આરતી અને શંખનાદ.": {
        hi: "सूर्यास्त के समय दीपमाला प्रज्वलित कर की जाने वाली भव्य आरती और शंखनाद।",
        en: "Magnificent sunset Aarti accompanied by traditional oil lamps, conch shells, and temple drums."
    },
    "શયન ભોગ & શયન આરતી (Shayan Aarti)": {
        hi: "शयन भोग & शयन आरती (Shayan Aarti)",
        en: "Shayan Bhog & Shayan Aarti"
    },
    "રાત્રે ૮:૩૦ થી ૯:૦૦ વાગ્યે": {
        hi: "रात ८:३० से ९:०० बजे",
        en: "8:30 PM - 9:00 PM"
    },
    "રાત્રિ ભોગ અર્પણ કર્યા બાદ ભગવાનના વિશ્રામ પૂર્વેની આરતી (૯:૩૦ વાગ્યે મંદિર મંગલ).": {
        hi: "रात्रि भोग अर्पित करने के बाद भगवान के विश्राम से पूर्व की आरती (रात ९:३० बजे मंदिर बंद होता है)।",
        en: "Final night Aarti after dinner offering before the Lord retires to sleep (Temple closes at 9:30 PM)."
    },

    // ================= 5. Section: History of Dwarka =================
    "પૌરાણિક અને વૈજ્ઞાનિક વારસો": {
        hi: "पौराणिक और वैज्ञानिक विरासत",
        en: "Mythological & Scientific Heritage"
    },
    "દ્વારકાનો ઇતિહાસ (History of Dwarka)": {
        hi: "द्वारका का इतिहास (History of Dwarka)",
        en: "History of Dwarka"
    },
    "દ્વાપર યુગમાં વિશ્વકર્મા દ્વારા સોનાની નગરીના નિર્માણથી લઈને અરબી સમુદ્રના પેટાળમાં ડૂબેલી દ્વારકાના આધુનિક સંશોધન સુધીનો રોમાંચક પ્રવાસ.": {
        hi: "द्वापर युग में विश्वकर्मा द्वारा सोने की नगरी के निर्माण से लेकर अरब सागर की गहराइयों में डूबी द्वारका के आधुनिक शोध तक का रोमांचक सफर।",
        en: "A fascinating journey from the creation of the Golden City by Vishwakarma in the Dwapara Yuga to modern marine archaeological discoveries in the Arabian Sea."
    },
    "દ્વાપર યુગ (આશરે ૫૦૦૦+ વર્ષ પૂર્વે)": {
        hi: "द्वापर युग (लगभग ५०००+ वर्ष पूर्व)",
        en: "Dwapara Yuga (Approx. 5000+ Years Ago)"
    },
    "ભગવાન શ્રીકૃષ્ણ દ્વારા સ્વર્ણ દ્વારકાનું નિર્માણ": {
        hi: "भगवान श्रीकृष्ण द्वारा स्वर्ण द्वारका का निर्माण",
        en: "Creation of Golden Dwarka by Lord Krishna"
    },
    "મથુરાના રાજા કંસના વધ બાદ જરાસંધના વારંવારના આક્રમણોથી મથુરાવાસીઓને સુરક્ષિત કરવા શ્રીકૃષ્ણએ યાદવો સાથે સૌરાષ્ટ્રના પશ્ચિમ સમુદ્રકાંઠે પ્રસ્થાન કર્યું. દેવશિલ્પી વિશ્વકર્મા દ્વારા સમુદ્ર પાસેથી ૧૨ યોજન જમીન માંગી સોનાની અદ્ભુત નગરી \"સ્વર્ણ દ્વારિકા\" બનાવી, જેમાં સેંકડો ભવ્ય મહેલો, સુવર્ણ કિલ્લાઓ અને બગીચાઓ હતા.": {
        hi: "मथुरा के राजा कंस के वध के बाद जरासंध के बार-बार के आक्रमणों से मथुरावासियों को सुरक्षित करने के लिए श्रीकृष्ण ने यादवों के साथ सौराष्ट्र के पश्चिमी समुद्र तट की ओर प्रस्थान किया। देवशिल्पी विश्वकर्मा ने समुद्र से १२ योजन भूमि मांगकर सोने की अद्भुत नगरी \"स्वर्ण द्वारिका\" बनाई, जिसमें सैकड़ों भव्य महल, स्वर्ण किले और उद्यान थे।",
        en: "After slaying King Kansa, to protect the people of Mathura from Jarasandha's repeated attacks, Lord Krishna migrated with the Yadavas to the western coast of Saurashtra. Reclaiming 12 Yojanas of land from the sea, celestial architect Vishwakarma built the magnificent 'Swarna Dwarka' with golden palaces, forts, and gardens."
    },
    "મહાભારત કાળ": {
        hi: "महाभारत काल",
        en: "Mahabharata Era"
    },
    "યાદવ વંશ અને મોક્ષપુરી": {
        hi: "यादव वंश और मोक्षपुरी",
        en: "Yadava Dynasty & Mokshapuri"
    },
    "દ્વારકા શ્રીકૃષ્ણના રાજ્યકાળ દરમિયાન ભારતના સૌથી સમૃદ્ધ અને શક્તિશાળી સામ્રાજ્ય તરીકે ઉભરી આવી. મહાભારતના ભીષણ યુદ્ધ બાદ ગાંધારીના શ્રાપ અને ઋષિઓના શાપને લીધે યાદવાસ્થળી સર્જાઈ.": {
        hi: "श्रीकृष्ण के शासनकाल के दौरान द्वारका भारत के सबसे समृद्ध और शक्तिशाली साम्राज्य के रूप में उभरी। महाभारत के भीषण युद्ध के बाद गांधारी के श्राप और ऋषियों के शाप के कारण यादवास्थली हुई।",
        en: "During Lord Krishna's reign, Dwarka flourished as India's most prosperous and powerful maritime kingdom. Later, following the Mahabharata war, Gandhari's curse and the sages' decree led to the end of the Yadava clan."
    },
    "શ્રીકૃષ્ણ સ્વધામ ગમન બાદ": {
        hi: "श्रीकृष्ण के स्वधाम गमन के बाद",
        en: "After Lord Krishna's Departure to Vaikuntha"
    },
    "દ્વારકાનું સમુદ્રમાં જળમગ્ન થવું": {
        hi: "द्वारका का समुद्र में जलमग्न होना",
        en: "Submergence of Golden Dwarka into the Ocean"
    },
    "ભગવાન શ્રીકૃષ્ણ ભાલકા તીર્થ (પ્રભાસ પાટણ) ખાતે સ્વધામ પધાર્યા બાદ અર્જુન દ્વારા યાદવ સ્ત્રી-બાળકોને સુરક્ષિત હસ્તિનાપુર લઈ જવાયા. ત્યારપછી તરત જ પ્રચંડ સુનામી અને દરિયાના મોજાં ઉછળ્યા અને ભવ્ય સ્વર્ણ દ્વારકા સમુદ્રના ગર્ભમાં સમાઈ ગઈ.": {
        hi: "भगवान श्रीकृष्ण के भालका तीर्थ (प्रभास पाटन) में स्वधाम पधारने के बाद अर्जुन द्वारा यादव महिलाओं और बच्चों को सुरक्षित हस्तिनापुर ले जाया गया। उसके तुरंत बाद प्रचंड समुद्री लहरें उठीं और भव्य स्वर्ण द्वारका समुद्र के गर्भ में समा गई।",
        en: "After Lord Krishna ascended to His divine abode at Bhalka Tirth, Arjuna escorted the remaining residents to Hastinapura. Immediately thereafter, massive ocean waves engulfed the majestic Golden City of Dwarka into the Arabian Sea."
    },
    "પ્રાચીન કાળ (પ્રપૌત્ર વજ્રનાભ દ્વારા)": {
        hi: "प्राचीन काल (प्रपौत्र वज्रनाभ द्वारा)",
        en: "Ancient Era (By Great-Grandson Vajranabha)"
    },
    "પ્રથમ જગત મંદિરનું નિર્માણ": {
        hi: "प्रथम जगत मंदिर का निर्माण",
        en: "Construction of the First Jagat Mandir"
    },
    "શ્રીકૃષ્ણના પ્રપૌત્ર વજ્રનાભ દ્વારા ભગવાનના મૂળ નિવાસ સ્થાન (હરિ ગૃહ) પર પ્રથમ છત્ર/મંદિરનું નિર્માણ કરાયું, જે \"જગત મંદિર\" તરીકે ઓળખાયું.": {
        hi: "श्रीकृष्ण के प्रपौत्र वज्रनाभ द्वारा भगवान के मूल निवास स्थान (हरि गृह) पर प्रथम छत्र/मंदिर का निर्माण कराया गया, जो \"जगत मंदिर\" के नाम से प्रसिद्ध हुआ।",
        en: "Vajranabha, the great-grandson of Lord Krishna, constructed the original temple over the Lord's residential palace (Hari Griha), which came to be revered as 'Jagat Mandir' (Universal Temple)."
    },
    "ઈ.સ. ૮મી સદી": {
        hi: "ई.स. ८वीं शताब्दी",
        en: "8th Century CE"
    },
    "આદિ શંકરાચાર્ય દ્વારા શારદા પીઠની સ્થાપના": {
        hi: "आदि शंकराचार्य द्वारा शारदा पीठ की स्थापना",
        en: "Establishment of Sharda Peeth by Adi Shankaracharya"
    },
    "જગતગુરુ આદિ શંકરાચાર્યજીએ સનાતન ધર્મના પુનરુત્થાન માટે ભારતના પશ્ચિમ ખૂણે દ્વારકામાં \"શારદા પીઠ\"ની સ્થાપના કરી, જેનાથી દ્વારકા ચાર ધામ પૈકીનું એક મુખ્ય ધામ બન્યું.": {
        hi: "जगद्गुरु आदि शंकराचार्यजी ने सनातन धर्म के पुनरुत्थान के लिए भारत के पश्चिमी कोने द्वारका में \"शारदा पीठ\" की स्थापना की, जिससे द्वारका चार धामों में से एक मुख्य धाम बना।",
        en: "Jagadguru Adi Shankaracharya established the western monastic seat 'Sharda Peeth' in Dwarka for the revival of Sanatan Dharma, crowning Dwarka as one of the four cardinal Char Dhams."
    },
    "ઈ.સ. ૧૬મી સદી અને પુનઃનિર્માણ": {
        hi: "ई.स. १६वीं शताब्दी और पुनर्निर्माण",
        en: "16th Century & Reconstruction"
    },
    "વર્તમાન ભવ્ય મંદિર સ્થાપત્ય": {
        hi: "वर्तमान भव्य मंदिर स्थापत्य",
        en: "Present Grand Temple Architecture"
    },
    "સમય જતાં વિવિધ આક્રમણો અને કુદરતી આપત્તિઓ વચ્ચે પણ ભક્તો અને રાજાઓએ મંદિરનું પુનઃનિર્માણ કર્યું. વર્તમાન મંદિર ચાલુક્ય શૈલી અને ૭૨ કલાત્મક સ્તંભો પર ચૂનાના પથ્થરોથી શોભી રહ્યું છે.": {
        hi: "समय के साथ विभिन्न आक्रमणों और प्राकृतिक आपदाओं के बीच भी भक्तों और राजाओं ने मंदिर का पुनर्निर्माण किया। वर्तमान मंदिर चालुक्य शैली और ७२ कलात्मक स्तंभों पर चूना पत्थरों से सुशोभित है।",
        en: "Resilient across centuries of invasions and natural calamities, the temple was lovingly restored by kings and devotees. The current limestone structure shines in Chalukya architectural style atop 72 carved pillars."
    },
    "આધુનિક યુગ (૧૯૮૩ થી ૨૦૨૪)": {
        hi: "आधुनिक युग (१९८३ से २०२४)",
        en: "Modern Era (1983 to 2024)"
    },
    "સમુદ્ર તળે સંશોધન (Underwater Archeology)": {
        hi: "समुद्र तल में शोध (Underwater Archaeology)",
        en: "Underwater Marine Archaeological Discoveries"
    },
    "પ્રખ્યાત પુરાતત્વવિદ્ ડૉ. એસ. આર. રાવ (ડૉ. એસ.આર. રાવ) અને ભારતીય નેવી દ્વારા સમુદ્રના પેટાળમાં સંશોધન કરાયું, જેમાં પ્રાચીન કિલ્લાની દીવાલો, ૫૦૦૦ વર્ષ જૂના પથ્થરના લંગર (Anchors) અને વાસણો મળ્યા. ૨૦૨૪માં ભારતના વડાપ્રધાન શ્રી નરેન્દ્ર મોદીજીએ સમુદ્રના તળિયે સ્કૂબા ડાઇવિંગ કરી મોરપીંછ અર્પણ કરી પ્રાચીન દ્વારકાની પૂજા કરી હતી.": {
        hi: "प्रसिद्ध पुरातत्वविद् डॉ. एस. आर. राव और भारतीय नौसेना द्वारा समुद्र की गहराई में शोध किया गया, जिसमें प्राचीन किले की दीवारें, ५००० वर्ष पुराने पत्थर के लंगर (Anchors) और बर्तन मिले। २०२४ में भारत के प्रधानमंत्री श्री नरेंद्र मोदीजी ने समुद्र तल में स्कूबा डाइविंग कर मोरपंख अर्पित कर प्राचीन द्वारका की पूजा की थी।",
        en: "Renowned archaeologist Dr. S. R. Rao and the Indian Navy conducted underwater excavations uncovering ancient fort walls, 5000-year-old stone ship anchors, and pottery. In 2024, Prime Minister Narendra Modi performed scuba diving to offer peacock feathers in reverence to submerged Dwarka."
    },
    "દરિયામાં ડૂબેલી દ્વારકાનું રહસ્ય (Underwater Submerged Dwarka)": {
        hi: "समुद्र में डूबी द्वारका का रहस्य (Underwater Submerged Dwarka)",
        en: "Mystery of Underwater Submerged Dwarka"
    },
    "પ્રખ્યાત પુરાતત્વશાસ્ત્રી ડૉ. એસ. આર. રાવ (Marine Archaeology Unit, NIO) દ્વારા દ્વારકાના દરિયાકિનારે ૧૯૮૩ થી ૧૯૯૦ દરમિયાન ઉત્ખનન કરવામાં આવ્યું હતું. સમુદ્રના તળિયેથી વિશાળ પથ્થરના કિલ્લાના અવશેષો, ત્રિકોણાકાર પથ્થરના લંગર (Ship Anchors), માટીના વાસણો અને ગોળ સ્તંભો મળી આવ્યા હતા જે ૫૦૦૦ વર્ષ જૂની સભ્યતા સાબિત કરે છે. ફેબ્રુઆરી ૨૦૨૪માં ભારતના વડાપ્રધાન શ્રી નરેન્દ્ર મોદીજીએ દ્વારકાના દરિયામાં સ્કૂબા ડાઇવિંગ કરીને પ્રાચીન જળમગ્ન દ્વારકા નગરીના દર્શન કર્યા હતા અને મોરપીંછ અર્પણ કરીને પૂજા કરી હતી.": {
        hi: "प्रसिद्ध पुरातत्वविद् डॉ. एस. आर. राव (Marine Archaeology Unit, NIO) द्वारा द्वारका के समुद्र तट पर १९८३ से १९९० के दौरान उत्खनन किया गया था। समुद्र के तल से विशाल पत्थर के किले के अवशेष, त्रिकोणीय पत्थर के लंगर (Ship Anchors), मिट्टी के बर्तन और गोल स्तंभ मिले थे जो ५००० वर्ष पुरानी सभ्यता को प्रमाणित करते हैं। फरवरी २०२४ में भारत के प्रधानमंत्री श्री नरेंद्र मोदीजी ने द्वारका के समुद्र में स्कूबा डाइविंग करके प्राचीन जलमग्न द्वारका नगरी के दर्शन किए थे और मोरपंख अर्पित करके पूजा की थी।",
        en: "Marine excavations led by eminent archaeologist Dr. S. R. Rao (National Institute of Oceanography) between 1983 and 1990 off the coast of Dwarka revealed massive stone fortification walls, three-holed triangular stone anchors, pottery, and circular bastions dating back over 5000 years. In February 2024, Prime Minister Narendra Modi dived deep into the Arabian Sea to pray at the submerged ruins of ancient Dwarka and offered sacred peacock feathers."
    },

    // ================= 6. Section: Places to Visit =================
    "પ્રવાસન અને દર્શન": {
        hi: "पर्यटन और दर्शन",
        en: "Tourism & Pilgrimage"
    },
    "દ્વારકા અને આજુબાજુના જોવાલાયક સ્થળો": {
        hi: "द्वारका और आसपास के दर्शनीय स्थल",
        en: "Places to Visit in & Around Dwarka"
    },
    "દ્વારકા શહેરમાં આવેલા પવિત્ર તીર્થો તથા આજુબાજુના આકર્ષક સ્થળો જેમ કે બેટ દ્વારકા, નાગેશ્વર અને શિવરાજપુર બીચ.": {
        hi: "द्वारका शहर में स्थित पवित्र तीर्थ और आसपास के आकर्षक स्थल जैसे बेट द्वारका, नागेश्वर और शिवराजपुर बीच।",
        en: "Sacred shrines inside Dwarka city and nearby attractions including Beyt Dwarka, Nageshwar Jyotirlinga, and Shivrajpur Blue Flag Beach."
    },
    "તમામ સ્થળો (All)": {
        hi: "सभी स्थल (All)",
        en: "All Places"
    },
    "દ્વારકા શહેરમાં (In City)": {
        hi: "द्वारका शहर में (In City)",
        en: "In Dwarka City"
    },
    "આજુબાજુના સ્થળો (Nearby)": {
        hi: "आसपास के स्थल (Nearby)",
        en: "Nearby Places"
    },
    "મંદિરો (Temples)": {
        hi: "मंदिर (Temples)",
        en: "Temples"
    },
    "દરિયાકિનારો / બીચ (Beach)": {
        hi: "समुद्र तट / बीच (Beach)",
        en: "Beaches"
    },
    "દ્વારકા શહેરમાં": {
        hi: "द्वारका शहर में",
        en: "In Dwarka City"
    },
    "સંપૂર્ણ માહિતી જુઓ": {
        hi: "पूरी जानकारी देखें",
        en: "View Full Details"
    },
    "વિગતવાર વર્ણન:": {
        hi: "विस्तृत विवरण:",
        en: "Detailed Description:"
    },
    "મુખ્ય આકર્ષણો:": {
        hi: "मुख्य आकर्षण:",
        en: "Key Highlights:"
    },
    "સમય:": {
        hi: "समय:",
        en: "Timings:"
    },
    "ટિકિટ:": {
        hi: "टिकट:",
        en: "Entry Fee:"
    },
    "અંતર:": {
        hi: "दूरी:",
        en: "Distance:"
    },

    // 11 Places Data
    "શ્રી દ્વારકાધીશ જગત મંદિર": {
        hi: "श्री द्वारकाधीश जगत मंदिर",
        en: "Shree Dwarkadhish Jagat Mandir"
    },
    "ભગવાન શ્રીકૃષ્ણ (રાજાધિરાજ)": {
        hi: "भगवान श्रीकृष्ण (राजाधिराज)",
        en: "Lord Shree Krishna (Rajadhiraj)"
    },
    "સવારે ૬:૩૦ થી બપોરે ૧:૦૦ અને સાંજે ૫:૦૦ થી રાત્રે ૯:૩૦": {
        hi: "सुबह ६:३० से दोपहर १:०० और शाम ५:०० से रात ९:३०",
        en: "6:30 AM - 1:00 PM & 5:00 PM - 9:30 PM"
    },
    "મફત (Free)": {
        hi: "निःशुल्क (Free)",
        en: "Free Entry"
    },
    "દ્વારકા શહેર કેન્દ્ર": {
        hi: "द्वारका शहर केंद्र",
        en: "Dwarka City Center"
    },
    "હિન્દુ ધર્મના પવિત્ર ચાર ધામ પૈકીનું પશ્ચિમ ધામ, ૭૨ સ્તંભો પર નિર્મિત ભવ્ય ૫ માળનું પૌરાણિક મંદિર.": {
        hi: "हिन्दू धर्म के पवित्र चार धामों में से पश्चिम धाम, ७२ स्तंभों पर निर्मित भव्य ५ मंजिला पौराणिक मंदिर।",
        en: "The sacred Western Dham of Hinduism, a magnificent 5-storey ancient temple supported by 72 carved pillars."
    },
    "દ્વારકાધીશ મંદિરને જગત મંદિર તરીકે પણ ઓળખવામાં આવે છે. આ મંદિર અંદાજે ૨૫૦૦ વર્ષથી પણ વધુ જૂનું માનવામાં આવે છે, જેનું મૂળ નિર્માણ ભગવાન શ્રીકૃષ્ણના પ્રપૌત્ર વજ્રનાભ દ્વારા કરવામાં આવ્યું હતું. મંદિરના શિખર પર ૫૨ ગજની ભવ્ય ધજા ફરકે છે, જે દિવસમાં ૬ વખત ચઢાવવામાં આવે છે. મંદિરમાં બે મુખ્ય પ્રવેશદ્વાર છે: સ્વર્ગ દ્વાર (ગોમતી ઘાટ તરફથી ૫૬ પગથિયાં ચઢીને) અને મોક્ષ દ્વાર (બજાર તરફ).": {
        hi: "द्वारकाधीश मंदिर को जगत मंदिर के रूप में भी जाना जाता है। यह मंदिर लगभग २५०० वर्ष से भी अधिक पुराना माना जाता है, जिसका मूल निर्माण भगवान श्रीकृष्ण के प्रपौत्र वज्रनाभ द्वारा किया गया था। मंदिर के शिखर पर ५२ गज की भव्य ध्वजा लहराती है, जिसे दिन में ६ बार चढ़ाया जाता है। मंदिर में दो मुख्य प्रवेश द्वार हैं: स्वर्ग द्वार (गोमती घाट की ओर से ५६ सीढ़ियाँ चढ़कर) और मोक्ष द्वार (बाजार की ओर)।",
        en: "Dwarkadhish Temple, revered as Jagat Mandir, is over 2,500 years old and was originally built by Lord Krishna's great-grandson Vajranabha. A grand 52-Gaj flag flutters atop its 78-meter spire and is hoisted 6 times a day. The temple features two sacred gates: Swarga Dwar (56 steps from Gomti Ghat) and Moksha Dwar (towards the main market)."
    },
    "૫૨ ગજની ધજા, સ્વર્ગ દ્વાર, મોક્ષ દ્વાર, ચાંદીના સિંહાસન પર બિરાજમાન ચતુર્ભુજ શ્યામ મૂર્તિ": {
        hi: "५२ गज की ध्वजा, स्वर्ग द्वार, मोक्ष द्वार, चांदी के सिंहासन पर विराजमान चतुर्भुज श्याम मूर्ति",
        en: "52-Gaj Dhwaja (hoisted 6 times daily), Swarga Dwar, Moksha Dwar, Four-armed black stone idol on a silver throne"
    },

    "ગોમતી ઘાટ અને સંગમ": {
        hi: "गोमती घाट और संगम",
        en: "Gomti Ghat and Sangam"
    },
    "પવિત્ર ગોમતી નદી અને અરબી સમુદ્ર": {
        hi: "पवित्र गोमती नदी और अरब सागर",
        en: "Holy Gomti River & Arabian Sea"
    },
    "સૂર્યોદય થી સૂર્યાસ્ત": {
        hi: "सूर्योदय से सूर्यास्त",
        en: "Sunrise to Sunset"
    },
    "જગત મંદિરની પાછળ (૫૬ પગથિયાં નીચે)": {
        hi: "जगत मंदिर के पीछे (५६ सीढ़ियाँ नीचे)",
        en: "Behind Jagat Mandir (56 Steps Down)"
    },
    "ગોમતી નદી અને અરબી સમુદ્રનો પવિત્ર સંગમ, જ્યાં સ્નાન કરવાનું મોક્ષદાયી મહત્વ છે.": {
        hi: "गोमती नदी और अरब सागर का पवित्र संगम, जहाँ स्नान करने का मोक्षदायी महत्व है।",
        en: "Sacred confluence of the Gomti River and Arabian Sea, where taking a holy dip is believed to grant liberation."
    },
    "ગોમતી ઘાટ દ્વારકાધીશ મંદિરની બિલકુલ સમીપ આવેલો છે. અહીં ગોમતી નદી અરબી સમુદ્રને મળે છે. પુરાણો અનુસાર ગોમતી સ્નાનથી તમામ પાપોમાંથી મુક્તિ મળે છે. ઘાટ પર ભક્તો માટે સ્નાન કરવાની સુંદર વ્યવસ્થા છે, અહીંથી બોટિંગ દ્વારા સમુદ્ર સંગમ સુધી પણ જઈ શકાય છે.": {
        hi: "गोमती घाट द्वारकाधीश मंदिर के बिल्कुल समीप स्थित है। यहाँ गोमती नदी अरब सागर से मिलती है। पुराणों के अनुसार गोमती स्नान से सभी पापों से मुक्ति मिलती है। घाट पर भक्तों के स्नान के लिए सुंदर व्यवस्था है, यहाँ से बोटिंग द्वारा समुद्र संगम तक भी जाया जा सकता है।",
        en: "Gomti Ghat lies right below the Dwarkadhish Temple steps where the holy Gomti River meets the Arabian Sea. Scriptures state that bathing in Gomti cleanses all sins. Boating rides to the Sangam point and camel rides on the bank are popular."
    },
    "પવિત્ર સ્નાન, સાંજની મહા આરતી, નૌકાવિહાર (Boating), ચક્રતીર્થ": {
        hi: "पवित्र स्नान, शाम की महाआरती, नौकाविहार (Boating), चक्रतीर्थ",
        en: "Holy Bath, Evening Maha Aarti, Boating to Sangam, Chakra Tirth"
    },

    "સુદામા સેતુ": {
        hi: "सुदामा सेतु",
        en: "Sudama Setu (Suspension Bridge)"
    },
    "શ્રીકૃષ્ણ-સુદામા મૈત્રી સ્મારક": {
        hi: "श्रीकृष्ण-सुदामा मैत्री स्मारक",
        en: "Lord Krishna & Sudama Friendship Memorial"
    },
    "સવારે ૭:૦૦ થી સાંજે ૭:૦૦": {
        hi: "सुबह ७:०० से शाम ७:००",
        en: "7:00 AM - 7:00 PM"
    },
    "₹૫૦ પ્રતિ વ્યક્તિ": {
        hi: "₹५० प्रति व्यक्ति",
        en: "₹50 per person"
    },
    "ગોમતી ઘાટ પાસે": {
        hi: "गोमती घाट के पास",
        en: "Near Gomti Ghat"
    },
    "ગોમતી નદી પર બનેલો આધુનિક કેબલ સસ્પેન્શન બ્રિજ, જે પંચનદ તીર્થ અને સમુદ્રતટ તરફ લઈ જાય છે.": {
        hi: "गोमती नदी पर बना आधुनिक केबल सस्पेंशन ब्रिज, जो पंचनद तीर्थ और समुद्र तट की ओर ले जाता है।",
        en: "Modern pedestrian cable-stayed bridge across the Gomti River connecting Jagat Mandir to Panchnad Tirth and the beach."
    },
    "સુદામા સેતુ ગોમતી નદીના બન્ને કાંઠાને જોડતો આકર્ષક કેબલ બ્રિજ છે. આ પુલ પરથી જગત મંદિર અને સમુદ્રનો અદ્ભુત નજારો જોવા મળે છે. પુલ પાર કરીને સામે કાંઠે આવેલા પંચનદ તીર્થ (પાંડવો દ્વારા ખોદાયેલા ૫ મીઠા પાણીના કૂવા) અને દરિયાકિનારે જઈ શકાય છે.": {
        hi: "सुदामा सेतु गोमती नदी के दोनों किनारों को जोड़ने वाला आकर्षक केबल ब्रिज है। इस पुल से जगत मंदिर और समुद्र का अद्भुत नजारा दिखाई देता है। पुल पार करके सामने तट पर स्थित पंचनद तीर्थ (पांडवों द्वारा खोदे गए ५ मीठे पानी के कुएं) और समुद्र किनारे जाया जा सकता है।",
        en: "Sudama Setu is a scenic pedestrian suspension bridge linking both banks of the Gomti River. It offers breathtaking views of the Jagat Mandir and the Arabian Sea. Crossing the bridge leads to Panchnad Tirth (5 sweet-water wells dug by the Pandavas right next to the salty sea) and the beach."
    },
    "કેબલ સસ્પેન્શન આર્કિટેક્ચર, અદ્ભુત ફોટોગ્રાફી પોઈન્ટ, કેમલ રાઈડ અને બીચ એક્ટિવિટી": {
        hi: "केबल सस्पेंशन आर्किटेक्चर, अद्भुत फोटोग्राफी पॉइंट, कैमल राइड और बीच एक्टिविटी",
        en: "Cable Suspension Architecture, Scenic Photography Point, Panchnad Wells, Camel Rides"
    },

    "ભડકેશ્વર મહાદેવ મંદિર": {
        hi: "भड़केश्वर महादेव मंदिर",
        en: "Bhadkeshwar Mahadev Temple"
    },
    "ભગવાન શિવ (સ્વયંભૂ શિવલિંગ)": {
        hi: "भगवान शिव (स्वयंभू शिवलिंग)",
        en: "Lord Shiva (Swayambhu Shivalinga)"
    },
    "સવારે ૬:૦૦ થી સાંજે ૭:૩૦": {
        hi: "सुबह ६:०० से शाम ७:३०",
        en: "6:00 AM - 7:30 PM"
    },
    "દ્વારકા શહેરથી ૨ કિ.મી.": {
        hi: "द्वारका शहर से २ कि.मी.",
        en: "2 km from Dwarka City"
    },
    "અરબી સમુદ્રની વચ્ચે એક નાની ટેકરી પર સ્થિત અતિ સુંદર પ્રાચીન શિવ મંદિર.": {
        hi: "अरब सागर के बीच एक छोटी पहाड़ी पर स्थित अति सुंदर प्राचीन शिव मंदिर।",
        en: "Picturesque ancient Shiva temple perched on a small hillock amidst the Arabian Sea."
    },
    "ભડકેશ્વર મહાદેવ મંદિર દરિયાના મોજાં વચ્ચે ટેકરી પર આવેલું છે. ચોમાસામાં ભરતી સમયે સમુદ્રનું પાણી ખુદ શિવલિંગનો જળાભિષેક કરે છે. અહીંથી સાંજના સમયે સૂર્યાસ્ત (Sunset) જોવાનો લહાવો અનિવાર્ય છે.": {
        hi: "भड़केश्वर महादेव मंदिर समुद्र की लहरों के बीच एक टेकरी पर स्थित है। मानसून और उच्च ज्वार के समय समुद्र का जल स्वयं शिवलिंग का जलाभिषेक करता है। यहाँ से शाम के समय सूर्यास्त (Sunset) देखने का आनंद अद्भुत है।",
        en: "Surrounded by the Arabian Sea, Bhadkeshwar Mahadev Temple enshrines a self-manifested (Swayambhu) Shivalinga. During high tide in monsoon, the sea waves naturally perform Jalabhishek of the shrine. It is the best sunset spot in Dwarka."
    },
    "દરિયા વચ્ચેનું રમણીય સ્થળ, સનસેટ વ્યૂ, સ્વયંભૂ શિવલિંગ": {
        hi: "समुद्र के बीच रमणीय स्थल, सनसेट व्यू, स्वयंभू शिवलिंग",
        en: "Temple amidst Ocean Waves, Spectacular Sunset View, Swayambhu Shivalinga"
    },

    "દ્વારકા બીચ અને દીવાદાંડી (લાઈટહાઉસ)": {
        hi: "द्वारका बीच और लाइटहाउस (दीवादंडी)",
        en: "Dwarka Beach & Lighthouse"
    },
    "પ્રકૃતિ અને સાગર દર્શન": {
        hi: "प्रकृति और सागर दर्शन",
        en: "Nature & Ocean Panorama"
    },
    "લાઈટહાઉસ: સાંજે ૪:૦૦ થી ૬:૦૦": {
        hi: "लाइटहाउस: शाम ४:०० से ६:००",
        en: "Lighthouse: 4:00 PM - 6:00 PM"
    },
    "લાઈટહાઉસ: ₹૧૫ - ₹૨૦": {
        hi: "लाइटहाउस: ₹१५ - ₹२०",
        en: "Lighthouse: ₹15 - ₹20"
    },
    "દ્વારકાથી ૧.૫ કિ.મી.": {
        hi: "द्वारका से १.५ कि.मी.",
        en: "1.5 km from Dwarka"
    },
    "અરબી સમુદ્રનો શાંત કિનારો અને ૪૩ મીટર ઊંચી ઐતિહાસિક દીવાદાંડી.": {
        hi: "अरब सागर का शांत किनारा और ४३ मीटर ऊँची ऐतिहासिक दीवादंडी (लाइटहाउस)।",
        en: "Serene Arabian Sea coastline and a historic 43-meter tall Lighthouse tower."
    },
    "દ્વારકાનો દરિયાકિનારો શાંત અને રમણીય છે. અહીં આવેલી દીવાદાંડીની ટોચ પર ચઢીને સમગ્ર દ્વારકા શહેર, અરબી સમુદ્ર અને જગત મંદિરનું ૩૬૦ ડિગ્રી અદ્ભુત વિહંગાવલોકન કરી શકાય છે.": {
        hi: "द्वारका का समुद्र तट शांत और रमणीय है। यहाँ स्थित लाइटहाउस के शीर्ष पर चढ़कर संपूर्ण द्वारका शहर, अरब सागर और जगत मंदिर का ३६० डिग्री अद्भुत विहंगावलोकन किया जा सकता है।",
        en: "Dwarka Beach offers a peaceful coastal promenade. Visitors can climb the 43-meter Lighthouse for a breathtaking 360-degree panoramic view of the Arabian Sea, Dwarka skyline, and the Jagat Mandir spire."
    },
    "વિહંગાવલોકન, ઠંડી સાગરી લહેરો, સાંજના સમયે પરિવાર સાથે બેસવા માટે ઉત્તમ સ્થળ": {
        hi: "विहंगावलोकन, ठंडी समुद्री लहरें, शाम के समय परिवार के साथ बैठने का उत्तम स्थान",
        en: "360° Aerial View, Cool Sea Breeze, Ideal Evening Family Spot"
    },

    "ગીતા મંદિર અને શારદા પીઠ": {
        hi: "गीता मंदिर और शारदा पीठ",
        en: "Gita Mandir and Sharda Peeth"
    },
    "શ્રીમદ્ ભગવદ્ ગીતા & આદિ શંકરાચાર્ય": {
        hi: "श्रीमद् भगवद् गीता & आदि शंकराचार्य",
        en: "Shrimad Bhagavad Gita & Adi Shankaracharya"
    },
    "સવારે ૭:૦૦ થી રાત્રે ૮:૦૦": {
        hi: "सुबह ७:०० से रात ८:००",
        en: "7:00 AM - 8:00 PM"
    },
    "જગત મંદિર પાસે": {
        hi: "जगत मंदिर के पास",
        en: "Near Jagat Mandir"
    },
    "બિરલા પરિવાર દ્વારા સંગેમરમરથી નિર્મિત ગીતા મંદિર અને આદિ શંકરાચાર્ય દ્વારા સ્થાપિત શારદા પીઠ.": {
        hi: "बिरला परिवार द्वारा संगमरमर से निर्मित गीता मंदिर और आदि शंकराचार्य द्वारा स्थापित शारदा पीठ।",
        en: "White marble Gita Mandir built by the Birla family and the historic Sharda Peeth founded by Adi Shankaracharya."
    },
    "ગીતા મંદિરની આરસપહાણની દીવાલો પર સંપૂર્ણ શ્રીમદ્ ભગવદ્ ગીતાના ૧૮ અધ્યાય અને ૭૦૦ શ્લોક કોતરેલા છે. પાસે જ આદિ શંકરાચાર્ય દ્વારા ભારતના ચાર ખૂણે સ્થાપેલા ચાર મઠો પૈકીનો પશ્ચિમ મઠ શારદા પીઠ આવેલો છે.": {
        hi: "गीता मंदिर की संगमरमर की दीवारों पर संपूर्ण श्रीमद् भगवद् गीता के १८ अध्याय और ७०० श्लोक उत्कीर्ण हैं। पास ही आदि शंकराचार्य द्वारा भारत के चारों कोनों में स्थापित चार मठों में से पश्चिम मठ 'शारदा पीठ' स्थित है।",
        en: "Built in 1970 with white marble, Gita Mandir has all 18 chapters and 700 verses of the Bhagavad Gita engraved on its walls. Nearby stands Sharda Peeth, the western cardinal monastery founded by Adi Shankaracharya."
    },
    "ગીતાજીના શ્લોકોનું કોતરણીકામ, આધ્યાત્મિક શાંતિ, ઐતિહાસિક શારદા મઠ": {
        hi: "गीताजी के श्लोकों की नक्काशी, आध्यात्मिक शांति, ऐतिहासिक शारदा मठ",
        en: "Engraved Bhagavad Gita Verses, White Marble Architecture, Historic Sharda Math"
    },

    "બેટ દ્વારકા (શંખોદ્ધાર બેટ)": {
        hi: "बेट द्वारका (शंखोद्धार बेट)",
        en: "Beyt Dwarka (Shankhodhar Island)"
    },
    "ભગવાન શ્રીકૃષ્ણ (રાજાધિરાજ - રહેઠાણ મહેલ)": {
        hi: "भगवान श्रीकृष्ण (राजाधिराज - निवास महल)",
        en: "Lord Shree Krishna (Ancient Royal Residence)"
    },
    "સવારે ૬:૩૦ થી બપોરે ૧૨:૦૦ અને સાંજે ૫:૦૦ થી ૯:૦૦": {
        hi: "सुबह ६:३० से दोपहर १२:०० और शाम ५:०० से ९:००",
        en: "6:30 AM - 12:00 PM & 5:00 PM - 9:00 PM"
    },
    "દ્વારકાથી ૩૨ કિ.મી. + બોટ/બ્રિજ": {
        hi: "द्वारका से ३२ कि.मी. + बोट/ब्रिज",
        en: "32 km from Dwarka + Bridge/Ferry"
    },
    "ભગવાન શ્રીકૃષ્ણનું પ્રાચીન રહેઠાણ અને જ્યાં સુદામાજી તાંદુલ (પૌંઆ) લઈને મળવા આવ્યા હતા તે પવિત્ર બેટ.": {
        hi: "भगवान श्रीकृष्ण का प्राचीन निवास स्थान और जहाँ सुदामाजी तंदुल (पोहा) लेकर मिलने आए थे वह पवित्र द्वीप।",
        en: "The sacred island residence of Lord Krishna where His childhood friend Sudama came to meet Him with a small bundle of rice."
    },
    "બેટ દ્વારકા એક ટાપુ છે જ્યાં શ્રીકૃષ્ણનો મુખ્ય નિવાસ માનવામાં આવે છે. અહીં શ્રીકૃષ્ણ, રુક્ષ્મણીજી, સત્યભામા અને જાંબવતીના સુંદર મંદિરો આવેલા છે. હવે નવનિર્મિત સુદર્શન સેતુ (ભારતનો સૌથી લાંબો કેબલ બ્રિજ) બની જવાથી ઓખાથી સીધા રોડ માર્ગે કે ફેરી બોટ દ્વારા પહોંચી શકાય છે.": {
        hi: "बेट द्वारका एक द्वीप है जहाँ श्रीकृष्ण का मुख्य निवास माना जाता है। यहाँ श्रीकृष्ण, रुक्मिणीजी, सत्यभामा और जांबवती के सुंदर मंदिर स्थित हैं। अब नवनिर्मित सुदर्शन सेतु (भारत का सबसे लंबा केबल ब्रिज) बन जाने से ओखा से सीधे सड़क मार्ग या फेरी बोट द्वारा पहुँचा जा सकता है।",
        en: "Beyt Dwarka is an island off the Okha coast revered as the residential palace of Lord Krishna and His queens (Rukmini, Satyabhama, Jambavati). With the newly inaugurated Sudarshan Setu (India's longest cable-stayed bridge), pilgrims can now drive directly to the island or take a traditional ferry boat."
    },
    "સુદર્શન સેતુ બ્રિજ, સુદામા-કૃષ્ણ મિલન સ્થળ, શંખની બનાવટોની ખરીદી, સમુદ્રી સૌંદર્ય": {
        hi: "सुदर्शन सेतु ब्रिज, सुदामा-कृष्ण मिलन स्थल, शंख की वस्तुओं की खरीदारी, समुद्री सौंदर्य",
        en: "Sudarshan Setu Cable Bridge, Krishna-Sudama Milan Sthal, Conch Shell Shopping, Hanuman Dandi"
    },

    "શ્રી નાગેશ્વર જ્યોતિર્લિંગ": {
        hi: "श्री नागेश्वर ज्योतिर्लिंग",
        en: "Shree Nageshwar Jyotirlinga"
    },
    "ભગવાન શિવ (૧૨ જ્યોતિર્લિંગ પૈકીનું દારૂકાવન જ્યોતિર્લિંગ)": {
        hi: "भगवान शिव (१२ ज्योतिर्लिंगों में से दारुकावन ज्योतिर्लिंग)",
        en: "Lord Shiva (One of the 12 Sacred Jyotirlingas)"
    },
    "સવારે ૬:૦૦ થી રાત્રે ૯:૦૦": {
        hi: "सुबह ६:०० से रात ९:००",
        en: "6:00 AM - 9:00 PM"
    },
    "દ્વારકાથી ૧૬ કિ.મી.": {
        hi: "द्वारका से १६ कि.मी.",
        en: "16 km from Dwarka"
    },
    "હિન્દુ ધર્મના અત્યંત પવિત્ર ૧૨ જ્યોતિર્લિંગ પૈકીનું એક દિવ્ય જ્યોતિર્લિંગ અને ભગવાન શિવની ૮૨ ફૂટ ઊંચી પ્રતિમા.": {
        hi: "हिन्दू धर्म के अत्यंत पवित्र १२ ज्योतिर्लिंगों में से एक दिव्य ज्योतिर्लिंग और भगवान शिव की ८२ फीट ऊँची विशाल प्रतिमा।",
        en: "One of the 12 sacred Jyotirlinga shrines of Lord Shiva, featuring a colossal 82-foot tall statue of Shiva."
    },
    "શિવપુરાણમાં વર્ણવેલા ૧૨ જ્યોતિર્લિંગોમાં નાગેશ્વર જ્યોતિર્લિંગ પ્રથમ ગણાતા દારૂકાવન વિસ્તારમાં આવેલું છે. મંદિરના પરિસરમાં ભગવાન શિવજીની ૮૨ ફૂટ ઊંચી ભવ્ય ધ્યાનસ્થ મૂર્તિ દેશ-વિદેશના યાત્રાળુઓનું મુખ્ય આકર્ષણ છે.": {
        hi: "शिवपुराण में वर्णित १२ ज्योतिर्लिंगों में नागेश्वर ज्योतिर्लिंग दारुकावन क्षेत्र में स्थित है। मंदिर परिसर में भगवान शिवजी की ८२ फीट ऊँची भव्य ध्यानस्थ मूर्ति देश-विदेश के श्रद्धालुओं का मुख्य आकर्षण है।",
        en: "Mentioned in the Shiva Purana as the Darukavana Jyotirlinga, Nageshwar Mahadev symbolizes protection from all poisons and negativity. The complex features an awe-inspiring 82-foot tall meditating statue of Lord Shiva."
    },
    "૧૨ જ્યોતિર્લિંગ દર્શન, ૮૨ ફૂટની વિશાળ શિવ પ્રતિમા, જળાભિષેક પૂજા": {
        hi: "१२ ज्योतिर्लिंग दर्शन, ८२ फीट की विशाल शिव प्रतिमा, जलाभिषेक पूजा",
        en: "12 Jyotirlinga Darshan, 82-ft Giant Shiva Statue, Rudrabhishek Pooja"
    },

    "શિવરાજપુર બ્લુ ફ્લેગ બીચ": {
        hi: "शिवराजपुर ब्लू फ्लैग बीच",
        en: "Shivrajpur Blue Flag Beach"
    },
    "પ્રકૃતિ અને સાહસિક વોટર સ્પોર્ટ્સ": {
        hi: "प्रकृति और साहसिक वाटर स्पोर्ट्स",
        en: "Nature & Adventure Water Sports"
    },
    "સવારે ૮:૦૦ થી સાંજે ૭:૦૦": {
        hi: "सुबह ८:०० से शाम ७:००",
        en: "8:00 AM - 7:00 PM"
    },
    "₹૩૦ પ્રતિ વ્યક્તિ (એન્ટ્રી)": {
        hi: "₹३० प्रति व्यक्ति (एंट्री)",
        en: "₹30 per person (Entry)"
    },
    "દ્વારકાથી ૧૨ કિ.મી.": {
        hi: "द्वारका से १२ कि.मी.",
        en: "12 km from Dwarka"
    },
    "આંતરરાષ્ટ્રીય કક્ષાનું \"Blue Flag\" પ્રમાણપત્ર ધરાવતો ગુજરાતનો સૌથી સ્વચ્છ અને સુંદર સફેદ રેતીનો દરિયાકિનારો.": {
        hi: "अंतर्राष्ट्रीय स्तर का \"Blue Flag\" प्रमाणपत्र प्राप्त गुजरात का सबसे स्वच्छ और सुंदर सफेद रेत वाला समुद्र तट।",
        en: "Gujarat's cleanest and most scenic white-sand beach certified with the prestigious international 'Blue Flag' eco-label."
    },
    "શિવરાજપુર બીચ ભારત સરકાર અને યુનેસ્કો દ્વારા પ્રમાણિત બ્લુ ફ્લેગ બીચ છે. અહીંનું પાણી કાચ જેવું પારદર્શક અને રેતી સોનેરી-સફેદ છે. અહીં સ્કૂબા ડાઇવિંગ, પેરાસેઇલિંગ, સ્નોર્કલિંગ, સ્પીડ બોટિંગ જેવી વોટર સ્પોર્ટ્સ ઉપલબ્ધ છે.": {
        hi: "शिवराजपुर बीच अंतर्राष्ट्रीय ब्लू फ्लैग प्रमाणित समुद्र तट है। यहाँ का पानी कांच जैसा पारदर्शी और रेत सुनहरी-सफेद है। यहाँ स्कूबा डाइविंग, पैरासेलिंग, स्नॉर्कलिंग, स्पीड बोटिंग जैसे रोमांचक वाटर स्पोर्ट्स उपलब्ध हैं।",
        en: "Shivrajpur Beach boasts crystal-clear turquoise waters and soft golden-white sands. Certified as a Blue Flag Beach, it is a hub for scuba diving, snorkeling, parasailing, speed boating, and safe family swimming."
    },
    "આંતરરાષ્ટ્રીય બ્લુ ફ્લેગ સર્ટિફિકેશન, સ્કૂબા ડાઇવિંગ, વોટર રાઈડ્સ, સ્વિમિંગ માટે સુરક્ષિત કિનારો": {
        hi: "अंतर्राष्ट्रीय ब्लू फ्लैग सर्टिफिकेशन, स्कूबा डाइविंग, वाटर राइड्स, स्विमिंग के लिए सुरक्षित तट",
        en: "International Blue Flag Certification, Scuba Diving, Water Rides, Safe Swimming Coast"
    },

    "શ્રી રુક્ષ્મણી દેવી મંદિર": {
        hi: "श्री रुक्मिणी देवी मंदिर",
        en: "Shree Rukmini Devi Temple"
    },
    "માતા રુક્ષ્મણીજી (શ્રીકૃષ્ણના પટ્ટરાણી)": {
        hi: "माता रुक्मिणीजी (श्रीकृष्ण की पटरानी)",
        en: "Goddess Rukmini (Chief Queen of Lord Krishna)"
    },
    "સવારે ૬:૦૦ થી રાત્રે ૮:૩૦": {
        hi: "सुबह ६:०० से रात ८:३०",
        en: "6:00 AM - 8:30 PM"
    },
    "દ્વારકાથી ૨.૫ કિ.મી.": {
        hi: "द्वारका से २.५ कि.मी.",
        en: "2.5 km from Dwarka"
    },
    "દ્વારકાધીશ મંદિરથી અલગ ૨.૫ કિમી દૂર સ્થિત ૧૨મી સદીનું પ્રાચીન કલાત્મક મંદિર.": {
        hi: "द्वारकाधीश मंदिर से २.५ किमी दूर स्थित १२वीं शताब्दी का प्राचीन कलात्मक मंदिर।",
        en: "Exquisitely carved 12th-century temple dedicated to Goddess Rukmini, located 2.5 km from the main temple."
    },
    "પૌરાણિક કથા મુજબ દુર્વાસા ઋષિના રથને ખેંચતી વખતે રુક્ષ્મણીજીને તરસ લાગતા શ્રીકૃષ્ણએ જમીનમાંથી ગંગાજી પ્રગટ કરી પાણી પાયું, જેનાથી દુર્વાસા ઋષિએ ક્રોધિત થઈને અલગ રહેવાનો શ્રાપ આપ્યો હતો. તેથી રુક્ષ્મણીજીનું મંદિર મુખ્ય મંદિરથી અલગ છે. આ મંદિર પર અદ્ભુત શિલ્પકળા અને હાથીઓની કોતરણી છે.": {
        hi: "पौराणिक कथा के अनुसार दुर्वासा ऋषि का रथ खींचते समय रुक्मिणीजी को प्यास लगने पर श्रीकृष्ण ने भूमि से गंगाजी को प्रकट कर जल पिलाया, जिससे क्रोधित होकर दुर्वासा ऋषि ने अलग रहने का श्राप दिया था। इसलिए रुक्मिणीजी का मंदिर मुख्य मंदिर से अलग है। इस मंदिर पर अद्भुत शिल्पकला और हाथियों की नक्काशी है।",
        en: "According to legend, while pulling Sage Durvasa's chariot, Rukmini grew thirsty and Lord Krishna summoned the Ganges from the earth with His toe without asking the sage first. Angered, Durvasa cursed them to live apart, which is why her shrine stands 2.5 km outside the city. There is a sacred custom of offering water (Jal Daan) here."
    },
    "દુર્વાસા ઋષિનો પૌરાણિક શ્રાપ અને જળદાન કથા, બેજોડ પથ્થર શિલ્પકળા": {
        hi: "दुर्वासा ऋषि का पौराणिक श्राप और जलदान कथा, बेजोड़ पत्थर शिल्पकला",
        en: "Legend of Sage Durvasa, Sacred Jal Daan Ritual, 12th-Century Stone Sculptures"
    },

    "ગોપી તળાવ": {
        hi: "गोपी तालाब",
        en: "Gopi Talav (Sacred Lake)"
    },
    "શ્રીકૃષ્ણ અને વ્રજની ગોપીઓ": {
        hi: "श्रीकृष्ण और ब्रज की गोपियाँ",
        en: "Lord Krishna & Gopis of Vraj"
    },
    "સવારે ૬:૦૦ થી સાંજે ૭:૦૦": {
        hi: "सुबह ६:०० से शाम ७:००",
        en: "6:00 AM - 7:00 PM"
    },
    "દ્વારકાથી ૨૧ કિ.મી.": {
        hi: "द्वारका से २१ कि.मी.",
        en: "21 km from Dwarka"
    },
    "જ્યાં શ્રીકૃષ્ણ સાથે રાસલીલા બાદ ગોપીઓ પવિત્ર જમીનમાં સમાઈ ગઈ હતી તે તળાવ, જ્યાંથી પીળી માટી (ગોપી ચંદન) મળે છે.": {
        hi: "जहाँ श्रीकृष्ण के साथ रासलीला के बाद गोपियाँ पवित्र भूमि में समा गई थीं वह तालाब, जहाँ से पीली मिट्टी (गोपी चंदन) मिलती है।",
        en: "Sacred lake where the Gopis of Vrindavan reunited with Lord Krishna for Maharaas and merged into the yellow earth, known as 'Gopi Chandan'."
    },
    "માન્યતા મુજબ વ્રજની ગોપીઓ શ્રીકૃષ્ણને મળવા દ્વારકા આવી હતી અને અહીં રાસ રમ્યા બાદ ધરતીમાં સમાઈ ગઈ હતી. આ તળાવની માટી અત્યંત મુલાયમ અને પીળા રંગની છે જેને \"ગોપી ચંદન\" કહેવાય છે. વૈષ્ણવ ભક્તો આ ચંદનનું તિલક ધારણ કરે છે.": {
        hi: "मान्यता के अनुसार ब्रज की गोपियाँ श्रीकृष्ण से मिलने द्वारका आई थीं और यहाँ शरद पूर्णिमा की रासलीला के बाद धरती में समा गई थीं। इस तालाब की मिट्टी अत्यंत मुलायम और पीले रंग की है जिसे \"गोपी चंदन\" कहा जाता है। वैष्णव भक्त इस चंदन का तिलक धारण करते हैं।",
        en: "Folklore narrates that the Gopis came to Dwarka to see Lord Krishna, performed their final Raas Leela here, and merged into the soil to remain with Him forever. The lake's smooth yellow clay is revered worldwide by Vaishnavas as 'Gopi Chandan'."
    },
    "પવિત્ર ગોપી ચંદન, માછલીઓને ખોરાક આપવો, શાંત વાતાવરણ": {
        hi: "पवित्र गोपी चंदन, मछलियों को दाना खिलाना, शांत आध्यात्मिक वातावरण",
        en: "Sacred Gopi Chandan Clay, Feeding Sacred Fish, Peaceful Spiritual Vibes"
    },

    // ================= 7. Section: Tour Timetable / Itinerary =================
    "ટૂર પ્લાન & આઈટિનરરી": {
        hi: "टूर प्लान & आइटिनररी",
        en: "Tour Plans & Itineraries"
    },
    "દ્વારકા ફરવા માટેનું સમયપત્રક (Time Table)": {
        hi: "द्वारका घूमने की समय-सारणी (Time Table)",
        en: "Dwarka Sightseeing Timetable & Itinerary"
    },
    "તમારા પ્રવાસના દિવસો મુજબ સુવ્યવસ્થિત કલાક-દર-કલાકનો ટૂર પ્લાન જેથી તમારા સમય અને પૈસાની બચત થાય.": {
        hi: "आपकी यात्रा के दिनों के अनुसार सुव्यवस्थित घंटे-दर-घंटे का टूर प्लान जिससे आपके समय और पैसे दोनों की बचत हो।",
        en: "Well-planned hour-by-hour itineraries tailored to your trip duration to save both time and money."
    },
    "૧ દિવસીય એક્સપ્રેસ ટૂર (1 Day)": {
        hi: "१ दिवसीय एक्सप्रेस टूर (1 Day)",
        en: "1-Day Express Tour"
    },
    "૨ દિવસીય શ્રેષ્ઠ પ્રવાસ (2 Days - ભલામણ કરેલ)": {
        hi: "२ दिवसीय श्रेष्ठ यात्रा (2 Days - अनुशंसित)",
        en: "2-Day Complete Tour (Recommended)"
    },
    "૩ દિવસીય આરામદાયક ટૂર (3 Days + બીચ)": {
        hi: "३ दिवसीय आरामदायक टूर (3 Days + बीच)",
        en: "3-Day Relaxed Tour (+ Beach)"
    },
    "૧ દિવસીય સુપર એક્સપ્રેસ દર્શન પ્લાન": {
        hi: "१ दिवसीय सुपर एक्सप्रेस दर्शन प्लान",
        en: "1-Day Super Express Darshan Plan"
    },
    "સમય બચત પ્લાન": {
        hi: "समय बचत प्लान",
        en: "Time-Saver Plan"
    },
    "૨ દિવસીય સંપૂર્ણ દ્વારકા & બેટ દ્વારકા યાત્રા": {
        hi: "२ दिवसीय संपूर्ण द्वारका & बेट द्वारका यात्रा",
        en: "2-Day Complete Dwarka & Beyt Dwarka Yatra"
    },
    "સૌથી લોકપ્રિય આઈટિનરરી": {
        hi: "सबसे लोकप्रिय आइटिनररी",
        en: "Most Popular Itinerary"
    },
    "૩ દિવસીય આરામદાયક દર્શન & શિવરાજપુર બીચ ટૂર": {
        hi: "३ दिवसीय आरामदायक दर्शन & शिवराजपुर बीच टूर",
        en: "3-Day Relaxed Darshan & Shivrajpur Beach Tour"
    },
    "ફેમિલી વેકેશન પ્લાન": {
        hi: "फैमिली वेकेशन प्लान",
        en: "Family Vacation Plan"
    },
    "સમયપત્રક પ્રિન્ટ / સેવ કરો": {
        hi: "समय-सारणी प्रिंट / सेव करें",
        en: "Print / Save Itinerary"
    },

    // Itinerary Slots
    "સવાર (૦૬:૦૦ થી ૧૧:૦૦)": {
        hi: "सुबह (०६:०० से ११:००)",
        en: "Morning (06:00 AM - 11:00 AM)"
    },
    "મંગળા આરતી, ગોમતી સ્નાન અને જગત મંદિર દર્શન": {
        hi: "मंगला आरती, गोमती स्नान और जगत मंदिर दर्शन",
        en: "Mangla Aarti, Gomti Bath & Jagat Mandir Darshan"
    },
    "સવારે ૬:૦૦ વાગ્યે ગોમતી ઘાટ પર પવિત્ર સ્નાન કરી ૫૬ પગથિયાં ચઢી સ્વર્ગ દ્વારથી જગત મંદિરમાં પ્રવેશ કરો. મંગળા આરતી અને શૃંગાર દર્શનનો લાભ લો. બાદમાં સુદામા સેતુ અને પંચનદ તીર્થની મુલાકાત લો.": {
        hi: "सुबह ६:०० बजे गोमती घाट पर पवित्र स्नान कर ५६ सीढ़ियाँ चढ़कर स्वर्ग द्वार से जगत मंदिर में प्रवेश करें। मंगला आरती और शृंगार दर्शन का लाभ लें। बाद में सुदामा सेतु और पंचनद तीर्थ की यात्रा करें।",
        en: "Take a holy dip at Gomti Ghat at 6:00 AM and climb 56 steps through Swarga Dwar into Jagat Mandir. Attend Mangla Aarti and Shringar Darshan, then cross Sudama Setu to visit Panchnad Tirth."
    },
    "બપોર (૧૧:૩૦ થી ૦૪:૩૦)": {
        hi: "दोपहर (११:३० से ०४:३०)",
        en: "Afternoon (11:30 AM - 04:30 PM)"
    },
    "બેટ દ્વારકા અને નાગેશ્વર જ્યોતિર્લિંગ યાત્રા": {
        hi: "बेट द्वारका और नागेश्वर ज्योतिर्लिंग यात्रा",
        en: "Beyt Dwarka & Nageshwar Jyotirlinga Excursion"
    },
    "કાઠિયાવાડી/ગુજરાતી થાળી જમીને લોકલ ટેક્સી કે બસ દ્વારા નાગેશ્વર જ્યોતિર્લિંગ દર્શન માટે નીકળો. ત્યાંથી ઓખા પહોંચી સુદર્શન સેતુ દ્વારા બેટ દ્વારકા દર્શન કરો. રસ્તામાં ગોપી તળાવ પણ જઈ શકો છો.": {
        hi: "काठियावाड़ी/गुजराती थाली का भोजन कर लोकल टैक्सी या बस से नागेश्वर ज्योतिर्लिंग दर्शन के लिए निकलें। वहाँ से ओखा पहुँचकर सुदर्शन सेतु द्वारा बेट द्वारका दर्शन करें। रास्ते में गोपी तालाब भी जा सकते हैं।",
        en: "After enjoying an authentic Gujarati/Kathiyawadi Thali lunch, head out by taxi or bus to Nageshwar Jyotirlinga, Gopi Talav, and drive across Sudarshan Setu to Beyt Dwarka."
    },
    "સાંજ (૦૫:૦૦ થી ૦૯:૦૦)": {
        hi: "शाम (०५:०० से ०९:००)",
        en: "Evening (05:00 PM - 09:00 PM)"
    },
    "રુક્ષ્મણી મંદિર, ભડકેશ્વર મહાદેવ અને સંધ્યા આરતી": {
        hi: "रुक्मिणी मंदिर, भड़केश्वर महादेव और संध्या आरती",
        en: "Rukmini Temple, Bhadkeshwar Sunset & Sandhya Aarti"
    },
    "પરત દ્વારકા આવી રુક્ષ્મણી માતાજીના દર્શન કરો. ભડકેશ્વર મહાદેવ ખાતે દરિયા વચ્ચે સુંદર સૂર્યાસ્ત માણો. રાત્રે દ્વારકાધીશ મંદિરમાં સંધ્યા આરતીના દર્શન કરી સ્થાનિક બજારમાં ખરીદી કરો.": {
        hi: "वापस द्वारका आकर रुक्मिणी माताजी के दर्शन करें। भड़केश्वर महादेव में समुद्र के बीच सुंदर सूर्यास्त का आनंद लें। रात में द्वारकाधीश मंदिर में संध्या आरती के दर्शन कर स्थानीय बाजार में खरीदारी करें।",
        en: "Return to Dwarka to visit Rukmini Devi Temple. Witness a magical sunset over the sea at Bhadkeshwar Mahadev, attend the grand Sandhya Aarti at Jagat Mandir, and shop in the local bazaar."
    },
    "દિવસ ૧: દ્વારકા નગરી દર્શન": {
        hi: "दिन १: द्वारका नगरी दर्शन",
        en: "Day 1: Dwarka City Darshan"
    },
    "ગોમતી ઘાટ, જગત મંદિર, ભડકેશ્વર અને દીવાદાંડી": {
        hi: "गोमती घाट, जगत मंदिर, भड़केश्वर और लाइटहाउस",
        en: "Gomti Ghat, Jagat Mandir, Bhadkeshwar & Lighthouse"
    },
    "પ્રથમ દિવસે સમગ્ર દ્વારકા શહેરના દર્શન: ગોમતી સ્નાન, જગત મંદિર દર્શન અને ધજા ચઢાવવાની વિધિ દર્શન, ગીતા મંદિર, શારદા પીઠ, બપોરે આરામ અને સાંજે ભડકેશ્વર મહાદેવ સનસેટ તથા લાઈટહાઉસ.": {
        hi: "पहले दिन संपूर्ण द्वारका शहर के दर्शन: गोमती स्नान, जगत मंदिर दर्शन और ध्वजारोहण विधि दर्शन, गीता मंदिर, शारदा पीठ, दोपहर में विश्राम और शाम को भड़केश्वर महादेव सनसेट तथा लाइटहाउस।",
        en: "Full day exploring Dwarka city: Holy bath at Gomti Ghat, Jagat Mandir darshan & Dhwaja hoisting ceremony, Gita Mandir, Sharda Peeth, afternoon rest, and evening sunset at Bhadkeshwar Mahadev & Lighthouse."
    },
    "દિવસ ૨: આસપાસના ધાર્મિક અને પ્રાકૃતિક તીર્થો": {
        hi: "दिन २: आसपास के धार्मिक और प्राकृतिक तीर्थ",
        en: "Day 2: Nearby Sacred Shrines & Blue Flag Beach"
    },
    "નાગેશ્વર, ગોપી તળાવ, બેટ દ્વારકા અને શિવરાજપુર બીચ": {
        hi: "नागेश्वर, गोपी तालाब, बेट द्वारका और शिवराजपुर बीच",
        en: "Nageshwar, Gopi Talav, Beyt Dwarka & Shivrajpur Beach"
    },
    "સવારે નાગેશ્વર જ્યોતિર્લિંગ દર્શન અને અભિષેક. ગોપી તળાવથી ગોપી ચંદન દર્શન. બેટ દ્વારકા શ્રીકૃષ્ણ નિવાસ દર્શન. બપોર પછી શિવરાજપુર બ્લુ ફ્લેગ બીચ પર પારદર્શક સાગરનો આનંદ અને વોટર સ્પોર્ટ્સ.": {
        hi: "सुबह नागेश्वर ज्योतिर्लिंग दर्शन और अभिषेक। गोपी तालाब से गोपी चंदन दर्शन। बेट द्वारका श्रीकृष्ण निवास दर्शन। दोपहर बाद शिवराजपुर ब्लू फ्लैग बीच पर पारदर्शी सागर का आनंद और वाटर स्पोर्ट्स।",
        en: "Morning Jalabhishek at Nageshwar Jyotirlinga, visit Gopi Talav, and cross Sudarshan Setu to Beyt Dwarka. Spend the afternoon enjoying crystal-clear waters and water sports at Shivrajpur Blue Flag Beach."
    },
    "દિવસ ૧: આધ્યાત્મિક દ્વારકા અનુભૂતિ": {
        hi: "दिन १: आध्यात्मिक द्वारका अनुभूति",
        en: "Day 1: Spiritual Immersion in Dwarka"
    },
    "મંગળા આરતી, ધ્વજારોહણ દર્શન અને પવિત્ર સ્નાન": {
        hi: "मंगला आरती, ध्वजारोहण दर्शन और पवित्र स्नान",
        en: "Mangla Aarti, Dhwaja Hoisting Ceremony & Holy Dip"
    },
    "પ્રથમ દિવસે પૂર્ણ શાંતિથી દ્વારકાધીશના તમામ દર્શન (મંગળા, શૃંગાર, રાજભોગ, સંધ્યા આરતી). ૫૨ ગજની ધજા ચઢાવવાનો ભક્તિભાવપૂર્વક ઉત્સવ જોવો. ગોમતી નૌકાવિહાર.": {
        hi: "पहले दिन पूर्ण शांति से द्वारकाधीश के सभी दर्शन (मंगला, शृंगार, राजभोग, संध्या आरती)। ५२ गज की ध्वजा चढ़ाने का भक्तिपूर्ण उत्सव देखना और गोमती नौकाविहार।",
        en: "Experience all daily darshans of Lord Dwarkadhish (Mangla, Shringar, Rajbhog, Sandhya Aarti) at a relaxed pace. Witness the grand 52-Gaj Dhwaja hoisting festival and enjoy boating at Gomti Sangam."
    },
    "દિવસ ૨: પૌરાણિક કથા માર્ગ (બેટ દ્વારકા & જ્યોતિર્લિંગ)": {
        hi: "दिन २: पौराणिक कथा मार्ग (बेट द्वारका & ज्योतिर्लिंग)",
        en: "Day 2: Mythological Trail (Beyt Dwarka & Jyotirlinga)"
    },
    "સુદર્શન સેતુ, શંખોદ્ધાર બેટ, ગોપી તળાવ અને નાગેશ્વર": {
        hi: "सुदर्शन सेतु, शंखोद्धार बेट, गोपी तालाब और नागेश्वर",
        en: "Sudarshan Setu, Beyt Dwarka, Gopi Talav & Nageshwar"
    },
    "આખો દિવસ બેટ દ્વારકા ટાપુ અને આસપાસના તીર્થો માટે. સુદર્શન સેતુ બ્રિજ પર ફોટોગ્રાફી, બેટ દ્વારકા મંદિર, રુક્ષ્મણી મંદિર, ગોપી તળાવ અને ૧૨ જ્યોતિર્લિંગ પૈકી નાગેશ્વર દર્શન.": {
        hi: "पूरा दिन बेट द्वारका द्वीप और आसपास के तीर्थों के लिए। सुदर्शन सेतु ब्रिज पर फोटोग्राफी, बेट द्वारका मंदिर, रुक्मिणी मंदिर, गोपी तालाब और १२ ज्योतिर्लिंगों में से एक नागेश्वर दर्शन।",
        en: "Full day dedicated to Beyt Dwarka island and surrounding shrines: scenic walk on Sudarshan Setu, Beyt Dwarka Mandir, Rukmini Temple, Gopi Talav, and Nageshwar Jyotirlinga."
    },
    "દિવસ ૩: કુદરતી સૌંદર્ય અને વિદાય": {
        hi: "दिन ३: प्राकृतिक सौंदर्य और विदाई",
        en: "Day 3: Coastal Beauty, Shopping & Departure"
    },
    "શિવરાજપુર બીચ, સ્કૂબા ડાઇવિંગ અને સ્થાનિક ખરીદી": {
        hi: "शिवराजपुर बीच, स्कूबा डाइविंग और स्थानीय खरीदारी",
        en: "Shivrajpur Beach, Scuba Diving & Souvenir Shopping"
    },
    "સવારે શિવરાજપુર બ્લુ ફ્લેગ બીચ પર સ્કૂબા ડાઇવિંગ / વોટર સ્પોર્ટ્સ. બપોરે દ્વારકાની પ્રખ્યાત પેંડા, પાપડ અને શંખ-છીપલાંની સ્થાનિક બજારમાંથી ખરીદી. સાંજે વિદાય.": {
        hi: "सुबह शिवराजपुर ब्लू फ्लैग बीच पर स्कूबा डाइविंग / वाटर स्पोर्ट्स। दोपहर में द्वारका के प्रसिद्ध पेड़े, पापड़ और शंख-सीपियों की स्थानीय बाजार से खरीदारी। शाम को प्रस्थान।",
        en: "Morning scuba diving and water sports at Shivrajpur Blue Flag Beach. Afternoon shopping in Dwarka's traditional bazaar for famous Thabdi Penda, papad, Gopi Chandan, and conch shells before departure."
    },

    // ================= 8. Section: Budget, Normal Hotel & Gujarati Food =================
    "ખર્ચ અને બજેટ વિશ્લેષણ": {
        hi: "खर्च और बजट विश्लेषण",
        en: "Cost & Budget Breakdown"
    },
    "દ્વારકા પ્રવાસનું બજેટ કેટલું થાય?": {
        hi: "द्वारका यात्रा का बजट कितना होता है?",
        en: "How Much Does a Trip to Dwarka Cost?"
    },
    "સામાન્ય હોટેલ, ધર્મશાળા, નોર્મલ ગુજરાતી અને કાઠિયાવાડી ભોજન તથા લોકલ વાહન વ્યવહારના વાસ્તવિક દરો.": {
        hi: "सामान्य होटल, धर्मशाला, नॉर्मल गुजराती और काठियावाड़ी भोजन तथा लोकल परिवहन के वास्तविक दर।",
        en: "Realistic prices for normal hotels, dharamshalas, unlimited Gujarati & Kathiyawadi thalis, and local transport."
    },
    "રોકાણ વિકલ્પો": {
        hi: "ठहरने के विकल्प",
        en: "Stay Options"
    },
    "સામાન્ય હોટેલ / ધર્મશાળા": {
        hi: "सामान्य होटल / धर्मशाला",
        en: "Normal Hotel / Dharamshala"
    },
    "પ્રતિ રૂમ / રાત્રિ (૨-૩ વ્યક્તિ)": {
        hi: "प्रति रूम / रात्रि (२-३ व्यक्ति)",
        en: "Per Room / Night (2-3 Guests)"
    },
    "સૌથી લોકપ્રિય": {
        hi: "सबसे लोकप्रिय",
        en: "Most Popular"
    },
    "નોર્મલ ગુજરાતી ભોજન": {
        hi: "नॉर्मल गुजराती भोजन",
        en: "Normal Gujarati Food"
    },
    "પ્રતિ થાળી (અમર્યાદિત ભોજન)": {
        hi: "प्रति थाली (असीमित भोजन)",
        en: "Per Thali (Unlimited Meal)"
    },
    "વાહન વ્યવહાર": {
        hi: "वाहन और परिवहन",
        en: "Local Transport"
    },
    "સ્થાનિક મુસાફરી ખર્ચ": {
        hi: "स्थानीय यात्रा खर्च",
        en: "Local Sightseeing Travel"
    },
    "બસ / ઓટો / ટેક્સી ભાડું": {
        hi: "बस / ऑटो / टैक्सी किराया",
        en: "Bus / Auto / Taxi Fare"
    },

    // Live Budget Calculator
    "લાઈવ બજેટ કેલ્ક્યુલેટર": {
        hi: "लाइव बजट कैलकुलेटर",
        en: "Live Budget Calculator"
    },
    "તમારા દિવસો અને વ્યક્તિઓની સંખ્યા પસંદ કરીને તમારા પ્રવાસનો અંદાજિત લાઈવ ખર્ચ ગણો.": {
        hi: "अपने दिनों और व्यक्तियों की संख्या चुनकर अपनी यात्रा का अनुमानित लाइव खर्च जानें।",
        en: "Select your trip days, group size, and preferences to calculate your estimated trip cost live."
    },
    "દિવસોની સંખ્યા (Days):": {
        hi: "दिनों की संख्या (Days):",
        en: "Number of Days:"
    },
    "વ્યક્તિઓની સંખ્યા (Persons):": {
        hi: "व्यक्तियों की संख्या (Persons):",
        en: "Number of Persons:"
    },
    "રોકાણ પ્રકાર (Stay Preference):": {
        hi: "ठहरने का प्रकार (Stay Preference):",
        en: "Stay Preference:"
    },
    "સામાન્ય ધર્મશાળા / આશ્રમ (₹૫૦૦/રાત્રિ)": {
        hi: "सामान्य धर्मशाला / आश्रम (₹५००/रात्रि)",
        en: "Dharamshala / Ashram (₹500/night)"
    },
    "નોર્મલ બજેટ હોટેલ (₹૧,૨૦૦/રાત્રિ)": {
        hi: "नॉर्मल बजट होटल (₹१,२००/रात्रि)",
        en: "Normal Budget Hotel (₹1,200/night)"
    },
    "પ્રીમિયમ હોટેલ / રિસોર્ટ (₹૨,૬૦૦/રાત્રિ)": {
        hi: "प्रीमियम होटल / रिसॉर्ट (₹२,६००/रात्रि)",
        en: "Premium Hotel / Resort (₹2,600/night)"
    },
    "ભોજન પ્રકાર (Food Preference):": {
        hi: "भोजन का प्रकार (Food Preference):",
        en: "Food Preference:"
    },
    "અન્નક્ષેત્ર / સાદું સાત્વિક ભોજન (₹૭૦/થાળી)": {
        hi: "अन्नक्षेत्र / सादा सात्विक भोजन (₹७०/थाली)",
        en: "Temple Annakshetra / Simple Meal (₹70/thali)"
    },
    "નોર્મલ કાઠિયાવાડી / ગુજરાતી અનલિમિટેડ થાળી (₹૧૩૦/થાળી)": {
        hi: "नॉर्मल काठियावाड़ी / गुजराती अनलिमिटेड थाली (₹१३०/थाली)",
        en: "Unlimited Gujarati / Kathiyawadi Thali (₹130/thali)"
    },
    "સ્પેશિયલ કાઠિયાવાડી + સ્વીટ / મિઠાઈ (₹૨૨૦/થાળી)": {
        hi: "स्पेशल काठियावाड़ी + मिठाई (₹२२०/थाली)",
        en: "Special Kathiyawadi Thali + Sweets (₹220/thali)"
    },
    "મુસાફરી વાહન (Travel Preference):": {
        hi: "यात्रा वाहन (Travel Preference):",
        en: "Local Travel Preference:"
    },
    "ભાષા પસંદ કરો (Language Preference):": {
        hi: "भाषा चुनें (Language Preference):",
        en: "Website Language (Language Preference):"
    },
    "લોકલ GSRTC બસ / શેરિંગ છકડો (₹૧૫૦/દિવસ/વ્યક્તિ)": {
        hi: "लोकल GSRTC बस / शेयरिंग रिक्शा (₹१५०/दिन/व्यक्ति)",
        en: "Local Bus / Shared Auto (₹150/day/person)"
    },
    "પ્રાઇવેટ ઓટો રિક્ષા (₹૮૦૦/દિવસ)": {
        hi: "प्राइवेट ऑटो रिक्शा (₹८००/दिन)",
        en: "Private Auto Rickshaw (₹800/day)"
    },
    "પ્રાઇવેટ AC ટેક્સી / કાર (₹૨,૨૦૦/દિવસ)": {
        hi: "प्राइवेट AC टैक्सी / कार (₹२,२००/दिन)",
        en: "Private AC Taxi / Car (₹2,200/day)"
    },
    "અંદાજિત ખર્ચનું વિભાજન": {
        hi: "अनुमानित खर्च का विवरण",
        en: "Estimated Cost Breakdown"
    },
    "હોટેલ / ધર્મશાળા ખર્ચ:": {
        hi: "होटल / धर्मशाला खर्च:",
        en: "Hotel / Dharamshala Stay:"
    },
    "જમવાનો ખર્ચ (૨ ટંક + નાસ્તો):": {
        hi: "भोजन खर्च (२ समय + नाश्ता):",
        en: "Food & Meals (2 Meals + Snacks):"
    },
    "સ્થાનિક ફરવાનો વાહન ખર્ચ:": {
        hi: "स्थानीय घूमने का वाहन खर्च:",
        en: "Local Sightseeing Transport:"
    },
    "પૂજા, પ્રસાદ, એન્ટ્રી ફી & પરચૂરણ:": {
        hi: "पूजा, प्रसाद, एंट्री फीस & विविध:",
        en: "Pooja, Prasad, Entry Fees & Misc:"
    },
    "કુલ અંદાજિત બજેટ (Total Budget)": {
        hi: "कुल अनुमानित बजट (Total Budget)",
        en: "Total Estimated Budget"
    },

    // ================= 9. Section: How to Reach =================
    "યાત્રા માર્ગદર્શન": {
        hi: "यात्रा मार्गदर्शन",
        en: "Travel Guide"
    },
    "દ્વારકા કેવી રીતે પહોંચવું? (How to Reach)": {
        hi: "द्वारका कैसे पहुँचें? (How to Reach)",
        en: "How to Reach Dwarka?"
    },
    "દ્વારકા રેલવે, હવાઈ અને સડક માર્ગે સમગ્ર ગુજરાત અને દેશના મુખ્ય શહેરો સાથે સુગમ રીતે જોડાયેલું છે.": {
        hi: "द्वारका रेलवे, हवाई और सड़क मार्ग द्वारा पूरे गुजरात और देश के प्रमुख शहरों से सुगमता से जुड़ा हुआ है।",
        en: "Dwarka is well-connected by rail, road, and nearby airports to major cities across Gujarat and India."
    },
    "રેલવે માર્ગ (By Train)": {
        hi: "रेलवे मार्ग (By Train)",
        en: "By Train (Railway)"
    },
    "હવાઈ માર્ગ (By Air)": {
        hi: "हवाई मार्ग (By Air)",
        en: "By Air (Nearest Airports)"
    },
    "સડક માર્ગ (By Road)": {
        hi: "सड़क मार्ग (By Road)",
        en: "By Road (Bus & Car)"
    },
    "ગુજરાત રાજ્ય પરિવહન (GSRTC) ની વોલ્વો, સ્લીપર અને એક્સપ્રેસ બસો અમદાવાદ, રાજકોટ, જામનગર, સોમનાથ, જૂનાગઢથી સીધી દ્વારકા આવે છે. ફોર-લેન હાઇવે હોવાથી પોતાની કાર દ્વારા મુસાફરી પણ ખૂબ આરામદાયક છે.": {
        hi: "गुजरात राज्य परिवहन (GSRTC) की वोल्वो, स्लीपर और एक्सप्रेस बसें अहमदाबाद, राजकोट, जामनगर, सोमनाथ, जूनागढ़ से सीधे द्वारका आती हैं। फोर-लेन हाईवे होने से अपनी कार द्वारा यात्रा भी बहुत आरामदायक है।",
        en: "GSRTC Volvo, Sleeper, and Express buses along with private luxury coaches run daily from Ahmedabad, Rajkot, Jamnagar, Somnath, and Junagadh. Smooth 4-lane highways make self-drive road trips effortless."
    },
    "દ્વારકા મુલાકાત માટે શ્રેષ્ઠ સમય:": {
        hi: "द्वारका यात्रा के लिए सर्वश्रेष्ठ समय:",
        en: "Best Time to Visit Dwarka:"
    },
    "ઓક્ટોબર થી માર્ચ:": {
        hi: "अक्टूबर से मार्च:",
        en: "October to March:"
    },
    "આહલાદક શિયાળાની ઋતુ. ઉપરાંત જન્માષ્ટમી (શ્રાવણ વદ આઠમ) નો મહોત્સવ દ્વારકામાં અતિ ભવ્યતાથી ઉજવાય છે.": {
        hi: "सुहावना सर्दियों का मौसम। इसके अलावा जन्माष्टमी का महोत्सव द्वारका में अति भव्यता से मनाया जाता है।",
        en: "Pleasant winter weather ideal for sightseeing. Additionally, the Janmashtami festival is celebrated with unmatched grandeur in Dwarka."
    },
    "૨૦°C - ૨૮°C": {
        hi: "२०°C - २८°C",
        en: "20°C - 28°C"
    },

    // ================= 10. Section: Feedback & Reviews =================
    "સંપર્ક & પ્રતિભાવ": {
        hi: "संपर्क & प्रतिक्रिया",
        en: "Contact & Reviews"
    },
    "યાત્રી પ્રતિભાવ અને પૂછપરછ": {
        hi: "यात्री प्रतिक्रिया और पूछताछ",
        en: "Pilgrim Reviews & Inquiries"
    },
    "તમારો દ્વારકા યાત્રાનો અનુભવ શેર કરો અથવા કોઈ પ્રશ્ન હોય તો પૂછો (ડેટાબેઝમાં સેવ થાય છે).": {
        hi: "अपनी द्वारका यात्रा का अनुभव साझा करें या कोई प्रश्न हो तो पूछें (डेटाबेस में सेव होता है)।",
        en: "Share your Dwarka pilgrimage experience or ask any travel question (saved directly to the database)."
    },
    "તમારો પ્રતિભાવ અથવા પ્રશ્ન લખો": {
        hi: "अपनी प्रतिक्रिया या प्रश्न लिखें",
        en: "Write Your Review or Question"
    },
    "તમારું પૂરું નામ *": {
        hi: "आपका पूरा नाम *",
        en: "Your Full Name *"
    },
    "તમારું શહેર / ગામ": {
        hi: "आपका शहर / गाँव",
        en: "Your City / Town"
    },
    "રેટિંગ (તમારો અનુભવ):": {
        hi: "रेटिंग (आपका अनुभव):",
        en: "Rating (Your Experience):"
    },
    "તમારો પ્રતિભાવ અથવા પ્રશ્ન *": {
        hi: "आपकी प्रतिक्रिया या प्रश्न *",
        en: "Your Review or Question *"
    },
    "પ્રતિભાવ સબમિટ કરો": {
        hi: "प्रतिक्रिया सबमिट करें",
        en: "Submit Review"
    },
    "તાજેતરના યાત્રી પ્રતિભાવો": {
        hi: "हाल ही की यात्री प्रतिक्रियाएँ",
        en: "Recent Pilgrim Reviews"
    },
    "રમેશભાઈ પટેલ": {
        hi: "रमेशभाई पटेल",
        en: "Rameshbhai Patel"
    },
    "અમદાવાદ": {
        hi: "अहमदाबाद",
        en: "Ahmedabad"
    },
    "(અમદાવાદ)": {
        hi: "(अहमदाबाद)",
        en: "(Ahmedabad)"
    },
    "દ્વારકામાં જગત મંદિરના દર્શન કરીને જીવન ધન્ય થઈ ગયું! ૫૨ ગજની ધજા અને ગોમતી ઘાટની સાંજ અદ્ભુત હતી. સામાન્ય હોટેલ અને ગુજરાતી થાળી ખૂબ સસ્તા અને સ્વાદિષ્ટ હતા.": {
        hi: "द्वारका में जगत मंदिर के दर्शन करके जीवन धन्य हो गया! ५२ गज की ध्वजा और गोमती घाट की शाम अद्भुत थी। सामान्य होटल और गुजराती थाली बहुत सस्ते और स्वादिष्ट थे।",
        en: "Blessed to have darshan at Jagat Mandir in Dwarka! The 52-Gaj Dhwaja and evening at Gomti Ghat were divine. Normal hotels and Gujarati thalis were very affordable and delicious."
    },
    "ભાવિક શાહ": {
        hi: "भाविक शाह",
        en: "Bhavik Shah"
    },
    "સુરત": {
        hi: "सूरत",
        en: "Surat"
    },
    "(સુરત)": {
        hi: "(सूरत)",
        en: "(Surat)"
    },
    "સુદર્શન સેતુ બ્રિજ ખૂબ જ સરસ બન્યો છે. બેટ દ્વારકા જવું હવે ખૂબ સરળ થઈ ગયું છે. શિવરાજપુર બીચનું પાણી ગોવા કરતાં પણ ચોખ્ખું છે!": {
        hi: "सुदर्शन सेतु ब्रिज बहुत ही शानदार बना है। बेट द्वारका जाना अब बहुत आसान हो गया है। शिवराजपुर बीच का पानी गोवा से भी अधिक साफ है!",
        en: "Sudarshan Setu bridge is an engineering marvel! Visiting Beyt Dwarka is so easy now, and the water at Shivrajpur Beach is even cleaner than Goa!"
    },
    "મીનાબેન જોશી": {
        hi: "मीनाबेन जोशी",
        en: "Meenaben Joshi"
    },
    "રાજકોટ": {
        hi: "राजकोट",
        en: "Rajkot"
    },
    "(રાજકોટ)": {
        hi: "(राजकोट)",
        en: "(Rajkot)"
    },
    "(યાત્રાળુ)": {
        hi: "(यात्री)",
        en: "(Pilgrim)"
    },
    "દ્વારકાની યાત્રા ખૂબ બજેટ-ફ્રેન્ડલી છે. ધર્મશાળામાં ₹૫૦૦-૬૦૦ માં સારો રૂમ મળી ગયો અને ₹૧૨૦ માં ઉત્તમ કાઠિયાવાડી થાળી મળી.": {
        hi: "द्वारका की यात्रा बहुत बजट-अनुकूल है। धर्मशाला में ₹५००-६०० में अच्छा कमरा मिल गया और ₹१२० में उत्तम काठियावाड़ी थाली मिली।",
        en: "Dwarka is a very budget-friendly pilgrimage. We got a clean Dharamshala room for ₹500-600 and a delicious unlimited Kathiyawadi thali for just ₹120."
    },

    // ================= 11. Footer =================
    "શ્રી દ્વારકા દર્શન": {
        hi: "श्री द्वारका दर्शन",
        en: "Shree Dwarka Darshan"
    },
    "પવિત્ર દ્વારકાધામ અંગે શ્રદ્ધાળુઓ અને પ્રવાસીઓને સાચી, સચોટ અને ઉપયોગી માહિતી આપતું અધિકૃત પોર્ટલ. જગત મંદિર દર્શન, સમયપત્રક અને બજેટનું વિશ્વસનીય માર્ગદર્શન.": {
        hi: "पवित्र द्वारकाधाम के बारे में श्रद्धालुओं और पर्यटकों को सही, सटीक और उपयोगी जानकारी देने वाला पोर्टल। जगत मंदिर दर्शन, समय-सारणी और बजट का विश्वसनीय मार्गदर्शन।",
        en: "Trusted portal providing devotees and travelers with accurate information about sacred Dwarka Dham, Jagat Mandir darshan timings, itineraries, and budget planning."
    },
    "મુખ્ય વિભાગો": {
        hi: "मुख्य विभाग",
        en: "Quick Links"
    },
    "જગત મંદિર & દર્શન": {
        hi: "जगत मंदिर & दर्शन",
        en: "Jagat Mandir & Darshan"
    },
    "દ્વારકાનો ઇતિહાસ": {
        hi: "द्वारका का इतिहास",
        en: "History of Dwarka"
    },
    "સમયપત્રક (Itinerary)": {
        hi: "समय-सारणी (Itinerary)",
        en: "Tour Itinerary"
    },
    "બજેટ & મુસાફરી": {
        hi: "बजट & यात्रा",
        en: "Budget & Travel"
    },
    "સામાન્ય હોટેલ દરો": {
        hi: "सामान्य होटल दरें",
        en: "Normal Hotel Rates"
    },
    "કાઠિયાવાડી ભોજન": {
        hi: "काठियावाड़ी भोजन",
        en: "Kathiyawadi Food"
    },
    "મહત્વના સ્થળો": {
        hi: "प्रमुख दर्शनीय स्थल",
        en: "Top Attractions"
    },
    "બેટ દ્વારકા (સુદર્શન સેતુ)": {
        hi: "बेट द्वारका (सुदर्शन सेतु)",
        en: "Beyt Dwarka (Sudarshan Setu)"
    },
    "નાગેશ્વર જ્યોતિર્લિંગ": {
        hi: "नागेश्वर ज्योतिर्लिंग",
        en: "Nageshwar Jyotirlinga"
    },
    "શિવરાજપુર બ્લુ ફ્લેગ બીચ": {
        hi: "शिवराजपुर ब्लू फ्लैग बीच",
        en: "Shivrajpur Blue Flag Beach"
    },
    "ભડકેશ્વર મહાદેવ": {
        hi: "भड़केश्वर महादेव",
        en: "Bhadkeshwar Mahadev"
    },
    "ગોમતી ઘાટ & સુદામા સેતુ": {
        hi: "गोमती घाट & सुदामा सेतु",
        en: "Gomti Ghat & Sudama Setu"
    },
    "એડમિન પેનલ (Admin Login)": {
        hi: "एडमिन पैनल (Admin Login)",
        en: "Admin Panel (Login)"
    }
};

const DWARKA_HTML_TRANSLATIONS = {
    ".hero-title": {
        hi: "भगवान श्रीकृष्ण की पवित्र <span>स्वर्ण नगरी द्वारिका</span>",
        en: "Lord Shree Krishna's Sacred <span>Golden City of Dwarka</span>"
    },
    "#about .about-card:nth-child(2) p": {
        hi: "पुराणों के अनुसार भारत में ७ नगरियाँ मोक्ष देने वाली हैं: अयोध्या, मथुरा, माया (हरिद्वार), काशी, कांची, अवंतिका (उज्जैन) और <strong>द्वारावती (द्वारका)</strong>। इन सप्तपुरियों में द्वारका का स्थान अद्वितीय है।",
        en: "According to the Puranas, seven sacred cities grant Moksha: Ayodhya, Mathura, Maya (Haridwar), Kashi, Kanchi, Avantika (Ujjain), and <strong>Dwaravati (Dwarka)</strong>. Among these Sapta Puris, Dwarka holds a supreme place."
    },
    "#temple .section-subtitle": {
        hi: "द्वारका में मुख्य मंदिर <strong>श्री द्वारकाधीश जगत मंदिर</strong> है, जहाँ भगवान श्रीकृष्ण \"राजाधिराज\" स्वरूप में विराजमान हैं।",
        en: "The principal shrine in Dwarka is <strong>Shree Dwarkadhish Jagat Mandir</strong>, where Lord Shree Krishna presides as 'Rajadhiraj' (King of Kings)."
    },
    ".mandir-highlights-list .mandir-highlight-item:nth-child(1) span": {
        hi: "<strong>५२ गज की ध्वजा:</strong> सूर्य-चंद्र अंकित ध्वजा शिखर पर दिन में ६ बार चढ़ाई जाती है।",
        en: "<strong>52-Gaj Dhwaja:</strong> Sacred flag with Sun & Moon symbols hoisted 6 times a day on the spire."
    },
    ".mandir-highlights-list .mandir-highlight-item:nth-child(2) span": {
        hi: "<strong>दो मुख्य द्वार:</strong> स्वर्ग द्वार (प्रवेश) और मोक्ष द्वार (निकास)।",
        en: "<strong>Two Main Gates:</strong> Swarga Dwar (Entry) and Moksha Dwar (Exit)."
    },
    ".mandir-highlights-list .mandir-highlight-item:nth-child(3) span": {
        hi: "<strong>शिखर ऊँचाई:</strong> लगभग ७८ मीटर (२५६ फीट) ऊँचा भव्य शिखर।",
        en: "<strong>Spire Height:</strong> Grand 78-meter (256 ft) high carved Shikhara."
    },
    ".mandir-highlights-list .mandir-highlight-item:nth-child(4) span": {
        hi: "<strong>अन्य मंदिर:</strong> बलरामजी, प्रद्युम्नजी, अनिरुद्धजी और रुक्मिणीजी।",
        en: "<strong>Other Shrines:</strong> Balramji, Pradyumnaji, Aniruddhaji & Goddess Rukmini."
    },
    "#reach .reach-card:nth-child(1) p": {
        hi: "<strong>द्वारका रेलवे स्टेशन (DWK)</strong> मंदिर से मात्र २.५ कि.मी. दूर है। अहमदाबाद, राजकोट, सूरत, मुंबई, दिल्ली, वाराणसी और पुणे से सीधी एक्सप्रेस और सुपरफास्ट ट्रेनें उपलब्ध हैं। स्टेशन के बाहर से निरंतर रिक्शा मिलते हैं।",
        en: "<strong>Dwarka Railway Station (DWK)</strong> is just 2.5 km from the main temple. Direct Express and Superfast trains connect Dwarka with Ahmedabad, Rajkot, Surat, Mumbai, Delhi, Varanasi, and Pune."
    },
    "#reach .reach-card:nth-child(2) p": {
        hi: "सबसे निकटतम डोमेस्टिक एयरपोर्ट <strong>जामनगर (Jamnagar - १३५ कि.मी.)</strong> और <strong>पोरबंदर (१०० कि.मी.)</strong> हैं। बड़े कनेक्शन के लिए <strong>राजकोट इंटरनेशनल एयरपोर्ट (Hirasar - २३० कि.मी.)</strong> श्रेष्ठ विकल्प है।",
        en: "The nearest domestic airports are <strong>Jamnagar (135 km)</strong> and <strong>Porbandar (100 km)</strong>. For major national connectivity, <strong>Rajkot International Airport (Hirasar - 230 km)</strong> is the best option."
    },
    ".budget-overview-grid .budget-tier-card:nth-child(1) .tier-list": {
        hi: `<li><i class="fa-solid fa-check"></i> <strong>सामान्य धर्मशाला / आश्रम / अतिथिगृह:</strong> ₹500 प्रति रूम / रात्रि (मंदिर के पास समाज की धर्मशालाएं, स्वच्छ कमरे, गर्म पानी और मूलभूत सुविधाएं)।</li>
             <li><i class="fa-solid fa-check"></i> <strong>नॉर्मल बजट होटल (AC / Non-AC):</strong> ₹1,200 प्रति रूम / रात्रि (सामान्य बजट होटल, टीवी, अटैच बाथरूम, लिफ्ट, वाईफाई और रूम सर्विस के साथ फैमिली रूम)।</li>
             <li><i class="fa-solid fa-check"></i> <strong>प्रीमियम / थ्री-स्टार होटल & रिसॉर्ट:</strong> ₹2,600 प्रति रूम / रात्रि (लक्जरी होटल, सी-व्यू, स्विमिंग पूल, रेस्टोरेंट और प्रीमियम सुविधाएं)।</li>`,
        en: `<li><i class="fa-solid fa-check"></i> <strong>Dharamshala / Ashram / Guest House:</strong> ₹500 per room / night (Clean community dharamshalas near the temple with hot water & basic amenities).</li>
             <li><i class="fa-solid fa-check"></i> <strong>Normal Budget Hotel (AC / Non-AC):</strong> ₹1,200 per room / night (Comfortable family rooms with TV, attached bath, lift, Wi-Fi & room service).</li>
             <li><i class="fa-solid fa-check"></i> <strong>Premium / 3-Star Hotel & Resort:</strong> ₹2,600 per room / night (Sea-view rooms, restaurant, parking & modern luxury amenities).</li>`
    },
    ".budget-overview-grid .budget-tier-card:nth-child(2) .tier-list": {
        hi: `<li><i class="fa-solid fa-check"></i> <strong>मंदिर अन्नक्षेत्र / सादा गुजराती भोजन:</strong> ₹70 प्रति थाली (मंदिर संचालित अन्नक्षेत्र या भोजनालय में रोटी, दाल, चावल, सब्जी का सात्विक भोजन)।</li>
             <li><i class="fa-solid fa-check"></i> <strong>नॉर्मल गुजराती / काठियावाड़ी अनलिमिटेड थाली:</strong> ₹130 प्रति थाली (द्वारका की प्रसिद्ध काठियावाड़ी थाली: २ सब्जी, रोटी/बाजरे का रोटला, दाल-चावल, गुड़, मक्खन, छाछ, पापड़)।</li>
             <li><i class="fa-solid fa-check"></i> <strong>प्रीमियम गुजराती स्पेशल थाली & मिठाई:</strong> ₹220 प्रति थाली (स्पेशल काठियावाड़ी थाली + फरसाण, मिठाई, पनीर सब्जी और स्पेशल मसाला छाछ)।</li>`,
        en: `<li><i class="fa-solid fa-check"></i> <strong>Temple Annakshetra / Simple Meal:</strong> ₹70 per thali (Pure sattvic meal of roti, dal, rice & sabzi at temple trusts or bhojanalayas).</li>
             <li><i class="fa-solid fa-check"></i> <strong>Normal Gujarati / Kathiyawadi Unlimited Thali:</strong> ₹130 per thali (2 sabzis, phulka roti / hot bajra rotla, dal-rice, jaggery, white butter, masala buttermilk & papad).</li>
             <li><i class="fa-solid fa-check"></i> <strong>Premium Special Thali & Sweet:</strong> ₹220 per thali (Special Kathiyawadi thali with farsan, sweet dish, paneer sabzi & special lassi/chaas).</li>`
    },
    ".budget-overview-grid .budget-tier-card:nth-child(3) .tier-list": {
        hi: `<li><i class="fa-solid fa-check"></i> <strong>लोकल GSRTC बस / शेयरिंग रिक्शा:</strong> ₹150 प्रति व्यक्ति / दिन (ओखा जाने के लिए लोकल बस या शेयरिंग रिक्शा, द्वारका लोकल भ्रमण)।</li>
             <li><i class="fa-solid fa-check"></i> <strong>प्राइवेट ऑटो रिक्शा (पूरा दिन / साइटसीइंग):</strong> ₹800 प्रति रिक्शा (३-४ व्यक्ति - भड़केश्वर, रुक्मिणी मंदिर, लाइटहाउस और लोकल दर्शन)।</li>
             <li><i class="fa-solid fa-check"></i> <strong>प्राइवेट AC टैक्सी / कार (द्वारका + बेट द्वारका + नागेश्वर):</strong> ₹2,200 प्रति कार / दिन (संपूर्ण आरामदायक एसी कार जिसमें द्वारका, नागेश्वर, गोपी तालाब, बेट द्वारका और शिवराजपुर बीच कवर होते हैं)।</li>`,
        en: `<li><i class="fa-solid fa-check"></i> <strong>Local GSRTC Bus / Shared Auto:</strong> ₹150 per person / day (Budget bus or shared auto to Okha, Nageshwar & local sightseeing).</li>
             <li><i class="fa-solid fa-check"></i> <strong>Private Auto Rickshaw (Full Day):</strong> ₹800 per auto (3-4 persons - covers Bhadkeshwar, Rukmini Temple, Lighthouse & local spots).</li>
             <li><i class="fa-solid fa-check"></i> <strong>Private AC Taxi / Car (Full Circuit):</strong> ₹2,200 per car / day (Comfortable AC Sedan/SUV covering Dwarka, Nageshwar, Gopi Talav, Beyt Dwarka & Shivrajpur Beach).</li>`
    },
    ".footer-bottom p": {
        hi: `© ${new Date().getFullYear()} पवित्र द्वारका यात्रा मार्गदर्शिका (About Dwarka Guide). सर्वाधिकार सुरक्षित। जय श्री द्वारकाधीश!`,
        en: `© ${new Date().getFullYear()} Sacred Dwarka Pilgrimage Guide (About Dwarka Guide). All Rights Reserved. Jay Shree Dwarkadhish!`
    }
};

function translateDynamicString(str, lang) {
    if (lang === 'gu' || !str) return str;

    const trimmed = str.trim().replace(/\s+/g, ' ');
    if (DWARKA_TRANSLATIONS[trimmed] && DWARKA_TRANSLATIONS[trimmed][lang]) {
        return DWARKA_TRANSLATIONS[trimmed][lang];
    }

    if (trimmed.startsWith('દ્વારકા નજીક (')) {
        const inner = trimmed.slice('દ્વારકા નજીક ('.length, -1);
        const transInner = translateDynamicString(inner, lang);
        return lang === 'hi' ? `द्वारका के पास (${transInner})` : `Near Dwarka (${transInner})`;
    }

    if (trimmed.startsWith('ટિકિટ: ')) {
        const inner = trimmed.slice('ટિકિટ: '.length);
        const transInner = translateDynamicString(inner, lang);
        return lang === 'hi' ? `टिकट: ${transInner}` : `Entry: ${transInner}`;
    }

    if (trimmed.startsWith('અંતર: ')) {
        const inner = trimmed.slice('અંતર: '.length);
        const transInner = translateDynamicString(inner, lang);
        return lang === 'hi' ? `दूरी: ${transInner}` : `Distance: ${transInner}`;
    }

    if (trimmed.startsWith('આવરી લીધેલ સ્થળો: ')) {
        const inner = trimmed.slice('આવરી લીધેલ સ્થળો: '.length);
        const spotsMap = {
            "ગોમતી ઘાટ, જગત મંદિર, સુદામા સેતુ, પંચનદ તીર્થ": {
                hi: "गोमती घाट, जगत मंदिर, सुदामा सेतु, पंचनद तीर्थ",
                en: "Gomti Ghat, Jagat Mandir, Sudama Setu, Panchnad Tirth"
            },
            "નાગેશ્વર જ્યોતિર્લિંગ, બેટ દ્વારકા, ગોપી તળાવ": {
                hi: "नागेश्वर ज्योतिर्लिंग, बेट द्वारका, गोपी तालाब",
                en: "Nageshwar Jyotirlinga, Beyt Dwarka, Gopi Talav"
            },
            "રુક્ષ્મણી મંદિર, ભડકેશ્વર મહાદેવ, દ્વારકા બજાર": {
                hi: "रुक्मिणी मंदिर, भड़केश्वर महादेव, द्वारका बाजार",
                en: "Rukmini Temple, Bhadkeshwar Mahadev, Dwarka Market"
            },
            "જગત મંદિર, ગોમતી ઘાટ, સુદામા સેતુ, ગીતા મંદિર, ભડકેશ્વર": {
                hi: "जगत मंदिर, गोमती घाट, सुदामा सेतु, गीता मंदिर, भड़केश्वर",
                en: "Jagat Mandir, Gomti Ghat, Sudama Setu, Gita Mandir, Bhadkeshwar"
            },
            "નાગેશ્વર, ગોપી તળાવ, બેટ દ્વારકા, સુદર્શન સેતુ, શિવરાજપુર બીચ": {
                hi: "नागेश्वर, गोपी तालाब, बेट द्वारका, सुदर्शन सेतु, शिवराजपुर बीच",
                en: "Nageshwar, Gopi Talav, Beyt Dwarka, Sudarshan Setu, Shivrajpur Beach"
            },
            "જગત મંદિર, ૫૨ ગજ ધ્વજા, ગોમતી સંગમ, સુદામા સેતુ": {
                hi: "जगत मंदिर, ५२ गज ध्वजा, गोमती संगम, सुदामा सेतु",
                en: "Jagat Mandir, 52-Gaj Dhwaja, Gomti Sangam, Sudama Setu"
            },
            "બેટ દ્વારકા, સુદર્શન સેતુ, ગોપી તળાવ, નાગેશ્વર, રુક્ષ્મણી મંદિર": {
                hi: "बेट द्वारका, सुदर्शन सेतु, गोपी तालाब, नागेश्वर, रुक्मिणी मंदिर",
                en: "Beyt Dwarka, Sudarshan Setu, Gopi Talav, Nageshwar, Rukmini Temple"
            },
            "શિવરાજપુર બ્લુ ફ્લેગ બીચ, સ્થાનિક બજાર, ખરીદી": {
                hi: "शिवराजपुर ब्लू फ्लैग बीच, स्थानीय बाजार, खरीदारी",
                en: "Shivrajpur Blue Flag Beach, Local Bazaar, Shopping"
            }
        };
        const transSpots = (spotsMap[inner] && spotsMap[inner][lang]) ? spotsMap[inner][lang] : inner;
        return lang === 'hi' ? `कवर किए गए स्थल: ${transSpots}` : `Spots Covered: ${transSpots}`;
    }

    // Fallback: if string contains Gujarati numerals (e.g., temperatures like ૨૦°C - ૨૮°C or prices), convert digits
    if (/[૦-૯]/.test(trimmed)) {
        const guDigits = ['૦', '૧', '૨', '૩', '૪', '૫', '૬', '૭', '૮', '૯'];
        const hiDigits = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];
        return trimmed.replace(/[૦-૯]/g, ch => {
            const idx = guDigits.indexOf(ch);
            if (idx === -1) return ch;
            return lang === 'hi' ? hiDigits[idx] : String(idx);
        });
    }

    return str;
}

const trackedTextNodes = [];
const trackedHtmlElements = [];

function updateLiveClockNow(lang) {
    const clockEl = document.getElementById('liveClock');
    if (!clockEl) return;
    const now = new Date();
    const activeLang = lang || window.currentLang || 'gu';
    const options = {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        hour12: true
    };
    const baseTime = now.toLocaleTimeString('en-US', options).toUpperCase();

    if (activeLang === 'hi') {
        const hiDigits = ['०', '१', '२', '३', '४', '५', '६', '७', '८', '९'];
        const hiTime = baseTime.replace(/\d/g, d => hiDigits[d]);
        clockEl.textContent = 'समय: ' + hiTime;
    } else if (activeLang === 'en') {
        clockEl.textContent = 'Time: ' + baseTime;
    } else {
        const guDigits = ['૦', '૧', '૨', '૩', '૪', '૫', '૬', '૭', '૮', '૯'];
        const guTime = baseTime.replace(/\d/g, d => guDigits[d]);
        clockEl.textContent = 'સમય: ' + guTime;
    }
}

function initLanguageSystem() {
    Object.keys(DWARKA_HTML_TRANSLATIONS).forEach(selector => {
        const el = document.querySelector(selector);
        if (el) {
            trackedHtmlElements.push({
                el: el,
                selector: selector,
                originalHtml: el.innerHTML
            });
        }
    });

    const walker = document.createTreeWalker(
        document.body,
        NodeFilter.SHOW_TEXT,
        {
            acceptNode: function (node) {
                if (!node.nodeValue || !node.nodeValue.trim()) return NodeFilter.FILTER_REJECT;
                const parent = node.parentElement;
                if (!parent) return NodeFilter.FILTER_REJECT;
                const tag = parent.tagName.toLowerCase();
                if (tag === 'script' || tag === 'style' || tag === 'noscript') return NodeFilter.FILTER_REJECT;
                if (parent.closest('.lang-select-sync')) return NodeFilter.FILTER_REJECT;
                if (parent.id === 'liveClock' || parent.closest('#liveClock')) return NodeFilter.FILTER_REJECT;
                return NodeFilter.FILTER_ACCEPT;
            }
        }
    );

    let currentNode;
    while ((currentNode = walker.nextNode())) {
        trackedTextNodes.push({
            node: currentNode,
            originalText: currentNode.nodeValue
        });
    }

    setLanguage(window.currentLang);
}

window.setLanguage = function (lang) {
    if (!['gu', 'hi', 'en'].includes(lang)) lang = 'gu';
    window.currentLang = lang;
    localStorage.setItem('dwarka_lang', lang);
    document.documentElement.lang = lang;

    // Sync all <select class="... lang-select-sync"> dropdowns on the page
    document.querySelectorAll('.lang-select-sync').forEach(sel => {
        if (sel.value !== lang) {
            sel.value = lang;
        }
    });

    // 1. Update HTML blocks
    trackedHtmlElements.forEach(item => {
        if (lang === 'gu') {
            item.el.innerHTML = item.originalHtml;
        } else {
            const trans = DWARKA_HTML_TRANSLATIONS[item.selector];
            if (trans && trans[lang]) {
                item.el.innerHTML = trans[lang];
            }
        }
    });

    // 2. Update Text Nodes
    trackedTextNodes.forEach(item => {
        if (!item.node.isConnected) return;
        const raw = item.originalText;
        const trimmed = raw.trim().replace(/\s+/g, ' ');

        if (lang === 'gu') {
            item.node.nodeValue = raw;
            return;
        }

        let translated = null;
        if (DWARKA_TRANSLATIONS[trimmed] && DWARKA_TRANSLATIONS[trimmed][lang]) {
            translated = DWARKA_TRANSLATIONS[trimmed][lang];
        } else {
            const dyn = translateDynamicString(trimmed, lang);
            if (dyn !== trimmed) {
                translated = dyn;
            }
        }

        if (translated) {
            const leadingSpace = raw.match(/^\s*/)[0];
            const trailingSpace = raw.match(/\s*$/)[0];
            item.node.nodeValue = leadingSpace + translated + trailingSpace;
        }
    });

    // 3. Update Form Placeholders
    const searchInput = document.getElementById('placeSearch');
    if (searchInput) {
        searchInput.placeholder = lang === 'gu'
            ? 'સ્થળ અથવા મંદિર શોધો...'
            : (lang === 'hi' ? 'स्थल या मंदिर खोजें...' : 'Search temple or place...');
    }

    const userNameInput = document.getElementById('userName');
    if (userNameInput) {
        userNameInput.placeholder = lang === 'gu'
            ? 'દા.ત. રમેશભાઈ પટેલ'
            : (lang === 'hi' ? 'उदा. रमेशभाई पटेल' : 'e.g. Rameshbhai Patel');
    }

    const userCityInput = document.getElementById('userCity');
    if (userCityInput) {
        userCityInput.placeholder = lang === 'gu'
            ? 'દા.ત. અમદાવાદ, સુરત, રાજકોટ...'
            : (lang === 'hi' ? 'उदा. अहमदाबाद, सूरत, राजकोट...' : 'e.g. Ahmedabad, Surat, Mumbai...');
    }

    const userCommentInput = document.getElementById('userComment');
    if (userCommentInput) {
        userCommentInput.placeholder = lang === 'gu'
            ? 'દ્વારકા યાત્રા અંગે તમારો અનુભવ અથવા કોઈ સલાહ-સૂચન...'
            : (lang === 'hi' ? 'द्वारका यात्रा के बारे में आपका अनुभव या कोई सुझाव...' : 'Share your Dwarka trip experience or inquiry...');
    }

    if (typeof window.refreshBudgetText === 'function') {
        window.refreshBudgetText();
    }
    if (typeof window.refreshClockText === 'function') {
        window.refreshClockText();
    } else {
        updateLiveClockNow(lang);
    }
};

window.getTranslatedPlaceData = function (placeData) {
    const lang = window.currentLang || 'gu';
    if (lang === 'gu') {
        return Object.assign({}, placeData, {
            title: placeData.name_gu,
            subtitle: placeData.name_en || '',
            deity: placeData.deity_gu ? 'આરાધ્ય દેવ: ' + placeData.deity_gu : '',
            desc: placeData.full_desc || placeData.short_desc
        });
    }

    const t = (str) => {
        if (!str) return '';
        const clean = str.trim().replace(/\s+/g, ' ');
        if (DWARKA_TRANSLATIONS[clean] && DWARKA_TRANSLATIONS[clean][lang]) {
            return DWARKA_TRANSLATIONS[clean][lang];
        }
        return translateDynamicString(clean, lang);
    };

    const deityPrefix = lang === 'hi' ? 'आराध्य देव: ' : 'Deity: ';
    const transName = lang === 'en' ? (placeData.name_en || t(placeData.name_gu)) : t(placeData.name_gu);
    const transDeity = placeData.deity_gu ? t(placeData.deity_gu) : '';
    const transDesc = t(placeData.full_desc || placeData.short_desc);

    return Object.assign({}, placeData, {
        name_gu: transName,
        deity_gu: transDeity,
        timings: t(placeData.timings || 'સવારે ૬:૦૦ થી રાત્રે ૯:૦૦'),
        entry_fee: t(placeData.entry_fee || 'મફત (Free)'),
        distance_km: t(placeData.distance_km || 'શહેરમાં'),
        full_desc: transDesc,
        short_desc: t(placeData.short_desc || ''),
        highlights: t(placeData.highlights || ''),
        title: transName,
        subtitle: placeData.name_en || '',
        deity: transDeity ? deityPrefix + transDeity : '',
        desc: transDesc
    });
};

document.addEventListener('DOMContentLoaded', initLanguageSystem);

