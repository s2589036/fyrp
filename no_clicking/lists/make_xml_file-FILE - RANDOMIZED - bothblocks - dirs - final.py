from random import shuffle
import os


def makeoneansweroption(truefalse, picname):
    return "\t\t\t\t<option>\n\t\t\t\t\t<text></text>\n\t\t\t\t\t<image>" + picname + ".jpg</image>\n\t\t\t\t\t<value>" + truefalse + " " + "(" + picname + ")</value>\n\t\t\t\t</option>\n"


def makeonequestion(word, goodpic, pic1, pic2, pic3, pic4):
    if goodpic == pic1:
        question = "\t\t<question>\n\t\t\t<text>" + word + "</text>\n\t\t\t<image></image>\n\t\t\t<audio></audio>\n\t\t\t<options>\n" + makeoneansweroption(
            "true", pic1) + makeoneansweroption("false", pic2) + makeoneansweroption("false",
                                                                                     pic3) + makeoneansweroption(
            "false", pic4) + "\t\t\t</options>\n\t\t</question>\n"

    if goodpic == pic2:
        question = "\t\t<question>\n\t\t\t<text>" + word + "</text>\n\t\t\t<image></image>\n\t\t\t<audio></audio>\n\t\t\t<options>\n" + makeoneansweroption(
            "false", pic1) + makeoneansweroption("true", pic2) + makeoneansweroption("false",
                                                                                     pic3) + makeoneansweroption(
            "false", pic4) + "\t\t\t</options>\n\t\t</question>\n"

    if goodpic == pic3:
        question = "\t\t<question>\n\t\t\t<text>" + word + "</text>\n\t\t\t<image></image>\n\t\t\t<audio></audio>\n\t\t\t<options>\n" + makeoneansweroption(
            "false", pic1) + makeoneansweroption("false", pic2) + makeoneansweroption("true",
                                                                                      pic3) + makeoneansweroption(
            "false", pic4) + "\t\t\t</options>\n\t\t</question>\n"

    if goodpic == pic4:
        question = "\t\t<question>\n\t\t\t<text>" + word + "</text>\n\t\t\t<image></image>\n\t\t\t<audio></audio>\n\t\t\t<options>\n" + makeoneansweroption(
            "false", pic1) + makeoneansweroption("false", pic2) + makeoneansweroption("false",
                                                                                      pic3) + makeoneansweroption(
            "true", pic4) + "\t\t\t</options>\n\t\t</question>\n"

    return question


def makebeginning(blocknumber, description, versionnumber):
    return "<list>\n\t<title>Block " + str(blocknumber) + "- Version " + str(
        versionnumber) + "</title>\n\t<description>" + description + "</description> \n"


def makeending():
    return "\t</questiontype>\n</list>"


def makequestionblock(name, amountasked):
    return "\t<questiontype>\n\t\t<name>" + name + "</name>\n\t\t<amountAsked>" + amountasked + "</amountAsked>\n"


def makefile(startnumber):
    # decide which 4 categories are the best
    c = ["tool", "kitchen", "food", "desk"]
    # ["boot","bird","bear","bread"] #MAYBE REPLACE ONE BY ONE OF THOSE
    shuffle(c)
    c = [""] + c

    numbers = [startnumber - i for i in range(16)]  # straks range(16)
    # allnumbers = [str(j) for j in range(16)]
    print("numbers: ", numbers)

    # finalnumbers = [str(n[k]) for k in range(16)]

    finalnumbers = []
    for n in numbers:
        if n != "":
            if (n <= 0):
                finalnumbers.append(str(n + 16))
            else:
                finalnumbers.append(str(n))

    finalnumbers = [""] + finalnumbers
    # print("goodnumber: ",finalnumbers)
    print("finalnumbers:", finalnumbers)

    w = ['barrion', 'cantee', 'hoppler', 'steeplump', 'wetchop', 'skizzle', 'tupress', 'looplab', 'trapsent', 'mesting',
         'claster', 'manedime', 'astion', 'novanoid', 'larsic', 'cowetter']

    # don't shuffle if you want every version to use a different words per target item /
    # shuffle if you want to randomize the order in which the words are presented
    # shuffle(w)

    dirnameblock1 = "questions-block1-v" + str(startnumber + 1)
    os.makedirs(dirnameblock1)

    filenameblock1 = dirnameblock1 + "/questions.xml"
    file1 = open(filenameblock1, "w")
    file1.write(str((makebeginning(1, "non-random", str(startnumber + 1)))))
    file1.write(str((makequestionblock("practice", "32"))))

    # w1
    file1.write(str((makeonequestion(w[0], c[1] + finalnumbers[1], c[1] + finalnumbers[2], c[1] + finalnumbers[1],
                                     c[1] + finalnumbers[3], c[4] + finalnumbers[2]))))
    file1.write(str((makeonequestion(w[0], c[1] + finalnumbers[1], c[4] + finalnumbers[3], c[2] + finalnumbers[2],
                                     c[1] + finalnumbers[1], c[3] + finalnumbers[2]))))
    file1.write(str((makeonequestion(w[0], c[1] + finalnumbers[1], c[4] + finalnumbers[4], c[1] + finalnumbers[1],
                                     c[2] + finalnumbers[3], c[3] + finalnumbers[3]))))
    file1.write(str((makeonequestion(w[0], c[1] + finalnumbers[1], c[1] + finalnumbers[1], c[3] + finalnumbers[4],
                                     c[2] + finalnumbers[4], c[1] + finalnumbers[4]))))

    # w2
    file1.write(str((makeonequestion(w[1], c[2] + finalnumbers[1], c[2] + finalnumbers[3], c[2] + finalnumbers[2],
                                     c[3] + finalnumbers[2], c[2] + finalnumbers[1]))))
    file1.write(str((makeonequestion(w[1], c[2] + finalnumbers[1], c[1] + finalnumbers[2], c[2] + finalnumbers[1],
                                     c[3] + finalnumbers[3], c[4] + finalnumbers[2]))))
    file1.write(str((makeonequestion(w[1], c[2] + finalnumbers[1], c[3] + finalnumbers[4], c[2] + finalnumbers[1],
                                     c[4] + finalnumbers[3], c[1] + finalnumbers[3]))))
    file1.write(str((makeonequestion(w[1], c[2] + finalnumbers[1], c[1] + finalnumbers[4], c[2] + finalnumbers[1],
                                     c[2] + finalnumbers[4], c[4] + finalnumbers[4]))))

    # w3
    file1.write(str((makeonequestion(w[2], c[3] + finalnumbers[1], c[3] + finalnumbers[1], c[2] + finalnumbers[2],
                                     c[3] + finalnumbers[2], c[3] + finalnumbers[3]))))
    file1.write(str((makeonequestion(w[2], c[3] + finalnumbers[1], c[2] + finalnumbers[3], c[3] + finalnumbers[1],
                                     c[1] + finalnumbers[2], c[4] + finalnumbers[2]))))
    file1.write(str((makeonequestion(w[2], c[3] + finalnumbers[1], c[2] + finalnumbers[4], c[4] + finalnumbers[6],
                                     c[3] + finalnumbers[1], c[1] + finalnumbers[6]))))
    file1.write(str((makeonequestion(w[2], c[3] + finalnumbers[1], c[1] + finalnumbers[4], c[3] + finalnumbers[1],
                                     c[3] + finalnumbers[4], c[4] + finalnumbers[7]))))

    # w4
    file1.write(str((makeonequestion(w[3], c[4] + finalnumbers[1], c[4] + finalnumbers[3], c[4] + finalnumbers[1],
                                     c[4] + finalnumbers[2], c[3] + finalnumbers[14]))))
    file1.write(str((makeonequestion(w[3], c[4] + finalnumbers[1], c[3] + finalnumbers[6], c[4] + finalnumbers[1],
                                     c[1] + finalnumbers[2], c[2] + finalnumbers[3]))))
    file1.write(str((makeonequestion(w[3], c[4] + finalnumbers[1], c[2] + finalnumbers[4], c[3] + finalnumbers[3],
                                     c[1] + finalnumbers[3], c[4] + finalnumbers[1]))))
    file1.write(str((makeonequestion(w[3], c[4] + finalnumbers[1], c[3] + finalnumbers[4], c[4] + finalnumbers[4],
                                     c[4] + finalnumbers[1], c[1] + finalnumbers[4]))))

    # w5
    file1.write(str((makeonequestion(w[4], c[1] + finalnumbers[9], c[1] + finalnumbers[15], c[1] + finalnumbers[11],
                                     c[1] + finalnumbers[9], c[4] + finalnumbers[10]))))
    file1.write(str((makeonequestion(w[4], c[1] + finalnumbers[9], c[1] + finalnumbers[9], c[2] + finalnumbers[10],
                                     c[3] + finalnumbers[10], c[4] + finalnumbers[11]))))
    file1.write(str((makeonequestion(w[4], c[1] + finalnumbers[9], c[2] + finalnumbers[11], c[3] + finalnumbers[11],
                                     c[4] + finalnumbers[12], c[1] + finalnumbers[9]))))
    file1.write(str((makeonequestion(w[4], c[1] + finalnumbers[9], c[1] + finalnumbers[9], c[2] + finalnumbers[12],
                                     c[3] + finalnumbers[12], c[1] + finalnumbers[12]))))

    # w6
    file1.write(str((makeonequestion(w[5], c[2] + finalnumbers[9], c[2] + finalnumbers[9], c[2] + finalnumbers[14],
                                     c[2] + finalnumbers[10], c[3] + finalnumbers[10]))))
    file1.write(str((makeonequestion(w[5], c[2] + finalnumbers[9], c[3] + finalnumbers[11], c[2] + finalnumbers[9],
                                     c[1] + finalnumbers[10], c[4] + finalnumbers[10]))))
    file1.write(str((makeonequestion(w[5], c[2] + finalnumbers[9], c[2] + finalnumbers[9], c[4] + finalnumbers[11],
                                     c[3] + finalnumbers[12], c[1] + finalnumbers[11]))))
    file1.write(str((makeonequestion(w[5], c[2] + finalnumbers[9], c[2] + finalnumbers[9], c[2] + finalnumbers[12],
                                     c[1] + finalnumbers[12], c[4] + finalnumbers[12]))))

    # w7
    file1.write(str((makeonequestion(w[6], c[3] + finalnumbers[9], c[3] + finalnumbers[8], c[2] + finalnumbers[10],
                                     c[3] + finalnumbers[10], c[3] + finalnumbers[9]))))
    file1.write(str((makeonequestion(w[6], c[3] + finalnumbers[9], c[2] + finalnumbers[11], c[1] + finalnumbers[14],
                                     c[4] + finalnumbers[10], c[3] + finalnumbers[9]))))
    file1.write(str((makeonequestion(w[6], c[3] + finalnumbers[9], c[3] + finalnumbers[9], c[1] + finalnumbers[11],
                                     c[4] + finalnumbers[11], c[2] + finalnumbers[12]))))
    file1.write(str((makeonequestion(w[6], c[3] + finalnumbers[9], c[3] + finalnumbers[15], c[4] + finalnumbers[15],
                                     c[2] + finalnumbers[12], c[3] + finalnumbers[9]))))

    # w8
    file1.write(str((makeonequestion(w[7], c[4] + finalnumbers[9], c[4] + finalnumbers[9], c[4] + finalnumbers[14],
                                     c[4] + finalnumbers[10], c[2] + finalnumbers[10]))))
    file1.write(str((makeonequestion(w[7], c[4] + finalnumbers[9], c[1] + finalnumbers[10], c[3] + finalnumbers[7],
                                     c[4] + finalnumbers[9], c[2] + finalnumbers[11]))))
    file1.write(str((makeonequestion(w[7], c[4] + finalnumbers[9], c[3] + finalnumbers[11], c[2] + finalnumbers[15],
                                     c[1] + finalnumbers[11], c[4] + finalnumbers[9]))))
    file1.write(str((makeonequestion(w[7], c[4] + finalnumbers[9], c[3] + finalnumbers[12], c[4] + finalnumbers[9],
                                     c[1] + finalnumbers[7], c[4] + finalnumbers[12]))))

    file1.write(str((makeending())))

    dirnameblock2 = "questions-block2-v" + str(startnumber + 1)
    os.makedirs(dirnameblock2)

    filenameblock2 = dirnameblock2 + "/questions.xml"
    file2 = open(filenameblock2, "w")
    file2.write(str((makebeginning(2, "random", str(startnumber + 1)))))
    file2.write(str((makequestionblock("practice", "32"))))

    # w9
    file2.write(str((makeonequestion(w[8], c[2] + finalnumbers[5], c[2] + finalnumbers[5], c[3] + finalnumbers[6],
                                     c[1] + finalnumbers[3], c[4] + finalnumbers[3]))))
    file2.write(str((makeonequestion(w[8], c[2] + finalnumbers[5], c[3] + finalnumbers[7], c[1] + finalnumbers[6],
                                     c[2] + finalnumbers[5], c[4] + finalnumbers[6]))))
    file2.write(str((makeonequestion(w[8], c[2] + finalnumbers[5], c[1] + finalnumbers[7], c[4] + finalnumbers[7],
                                     c[2] + finalnumbers[5], c[3] + finalnumbers[8]))))
    file2.write(str((makeonequestion(w[8], c[2] + finalnumbers[5], c[1] + finalnumbers[8], c[4] + finalnumbers[8],
                                     c[2] + finalnumbers[5], c[2] + finalnumbers[7]))))

    # w10
    file2.write(str((makeonequestion(w[9], c[1] + finalnumbers[5], c[3] + finalnumbers[2], c[1] + finalnumbers[5],
                                     c[2] + finalnumbers[2], c[4] + finalnumbers[6]))))
    file2.write(str((makeonequestion(w[9], c[1] + finalnumbers[5], c[1] + finalnumbers[5], c[4] + finalnumbers[7],
                                     c[3] + finalnumbers[6], c[2] + finalnumbers[6]))))
    file2.write(str((makeonequestion(w[9], c[1] + finalnumbers[5], c[1] + finalnumbers[5], c[4] + finalnumbers[8],
                                     c[3] + finalnumbers[7], c[2] + finalnumbers[7]))))
    file2.write(str((makeonequestion(w[9], c[1] + finalnumbers[5], c[3] + finalnumbers[8], c[1] + finalnumbers[5],
                                     c[2] + finalnumbers[8], c[1] + finalnumbers[8]))))

    # w11
    file2.write(str((makeonequestion(w[10], c[3] + finalnumbers[5], c[2] + finalnumbers[6], c[1] + finalnumbers[8],
                                     c[4] + finalnumbers[4], c[3] + finalnumbers[5]))))
    file2.write(str((makeonequestion(w[10], c[3] + finalnumbers[5], c[3] + finalnumbers[5], c[2] + finalnumbers[7],
                                     c[1] + finalnumbers[6], c[4] + finalnumbers[6]))))
    file2.write(str((makeonequestion(w[10], c[3] + finalnumbers[5], c[2] + finalnumbers[8], c[1] + finalnumbers[7],
                                     c[4] + finalnumbers[7], c[3] + finalnumbers[5]))))
    file2.write(str((makeonequestion(w[10], c[3] + finalnumbers[5], c[2] + finalnumbers[8], c[3] + finalnumbers[15],
                                     c[3] + finalnumbers[5], c[4] + finalnumbers[8]))))

    # w12
    file2.write(str((makeonequestion(w[11], c[4] + finalnumbers[5], c[2] + finalnumbers[6], c[1] + finalnumbers[12],
                                     c[4] + finalnumbers[5], c[3] + finalnumbers[12]))))
    file2.write(str((makeonequestion(w[11], c[4] + finalnumbers[5], c[4] + finalnumbers[5], c[2] + finalnumbers[7],
                                     c[3] + finalnumbers[6], c[1] + finalnumbers[6]))))
    file2.write(str((makeonequestion(w[11], c[4] + finalnumbers[5], c[3] + finalnumbers[7], c[2] + finalnumbers[8],
                                     c[4] + finalnumbers[5], c[1] + finalnumbers[7]))))
    file2.write(str((makeonequestion(w[11], c[4] + finalnumbers[5], c[4] + finalnumbers[5], c[1] + finalnumbers[8],
                                     c[4] + finalnumbers[8], c[3] + finalnumbers[8]))))

    # w13
    file2.write(str((makeonequestion(w[12], c[1] + finalnumbers[13], c[3] + finalnumbers[10], c[2] + finalnumbers[11],
                                     c[1] + finalnumbers[13], c[4] + finalnumbers[14]))))
    file2.write(str((makeonequestion(w[12], c[1] + finalnumbers[13], c[1] + finalnumbers[13], c[4] + finalnumbers[15],
                                     c[2] + finalnumbers[14], c[3] + finalnumbers[14]))))
    file2.write(str((makeonequestion(w[12], c[1] + finalnumbers[13], c[2] + finalnumbers[15], c[1] + finalnumbers[13],
                                     c[4] + finalnumbers[16], c[3] + finalnumbers[15]))))
    file2.write(str((makeonequestion(w[12], c[1] + finalnumbers[13], c[1] + finalnumbers[13], c[3] + finalnumbers[16],
                                     c[2] + finalnumbers[16], c[1] + finalnumbers[16]))))

    # w14
    file2.write(str((makeonequestion(w[13], c[2] + finalnumbers[13], c[2] + finalnumbers[13], c[3] + finalnumbers[14],
                                     c[4] + finalnumbers[11], c[1] + finalnumbers[10]))))
    file2.write(str((makeonequestion(w[13], c[2] + finalnumbers[13], c[3] + finalnumbers[15], c[1] + finalnumbers[14],
                                     c[4] + finalnumbers[14], c[2] + finalnumbers[13]))))
    file2.write(str((makeonequestion(w[13], c[2] + finalnumbers[13], c[3] + finalnumbers[16], c[4] + finalnumbers[15],
                                     c[2] + finalnumbers[13], c[1] + finalnumbers[15]))))
    file2.write(str((makeonequestion(w[13], c[2] + finalnumbers[13], c[2] + finalnumbers[13], c[2] + finalnumbers[16],
                                     c[1] + finalnumbers[16], c[4] + finalnumbers[16]))))

    # w15
    file2.write(str((makeonequestion(w[14], c[3] + finalnumbers[13], c[2] + finalnumbers[14], c[1] + finalnumbers[10],
                                     c[3] + finalnumbers[13], c[4] + finalnumbers[12]))))
    file2.write(str((makeonequestion(w[14], c[3] + finalnumbers[13], c[4] + finalnumbers[14], c[2] + finalnumbers[15],
                                     c[3] + finalnumbers[13], c[1] + finalnumbers[14]))))
    file2.write(str((makeonequestion(w[14], c[3] + finalnumbers[13], c[3] + finalnumbers[13], c[1] + finalnumbers[15],
                                     c[2] + finalnumbers[6], c[4] + finalnumbers[15]))))
    file2.write(str((makeonequestion(w[14], c[3] + finalnumbers[13], c[3] + finalnumbers[13], c[3] + finalnumbers[16],
                                     c[2] + finalnumbers[16], c[4] + finalnumbers[16]))))

    # w16
    file2.write(str((makeonequestion(w[15], c[4] + finalnumbers[13], c[4] + finalnumbers[13], c[1] + finalnumbers[12],
                                     c[2] + finalnumbers[14], c[3] + finalnumbers[11]))))
    file2.write(str((makeonequestion(w[15], c[4] + finalnumbers[13], c[4] + finalnumbers[13], c[2] + finalnumbers[15],
                                     c[3] + finalnumbers[14], c[1] + finalnumbers[14]))))
    file2.write(str((makeonequestion(w[15], c[4] + finalnumbers[13], c[2] + finalnumbers[16], c[1] + finalnumbers[15],
                                     c[4] + finalnumbers[13], c[3] + finalnumbers[15]))))
    file2.write(str((makeonequestion(w[15], c[4] + finalnumbers[13], c[4] + finalnumbers[13], c[1] + finalnumbers[16],
                                     c[3] + finalnumbers[16], c[4] + finalnumbers[16]))))

    file2.write(str((makeending())))

    return [file1, file2]


def main():
    for i in range(16):
        makefile(i)


main()
